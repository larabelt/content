<?php namespace Tests\Belt\Content\Unit\Services;

use Mockery as m;
use Belt\Core\Facades\MorphFacade as Morph;
use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Attachment;
use Belt\Content\Adapters\AdapterFactory;
use Belt\Content\Adapters\BaseAdapter;
use Belt\Content\Adapters\LocalAdapter;
use Belt\Content\Jobs\MoveAttachment;
use Belt\Content\Services\MoveService;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Queue;

class MoveServiceTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        parent::setUp();
        app()['config']->set('filesystems.disks.local', [
            'driver' => 'local',
            'root' => storage_path('app'),
        ]);
        app()['config']->set('belt.content.drivers.foo', [
            'disk' => 'local',
            'adapter' => LocalAdapter::class,
            'prefix' => 'foo',
            'src' => ['root' => 'http://foo.local'],
            'secure' => ['root' => 'https://foo.local'],
        ]);
        app()['config']->set('belt.content.drivers.bar', [
            'disk' => 'local',
            'adapter' => LocalAdapter::class,
            'prefix' => 'bar',
            'src' => ['root' => 'http://bar.local'],
            'secure' => ['root' => 'https://bar.local'],
        ]);
    }

    /**
     * @covers \Belt\Content\Services\MoveService::__construct
     * @covers \Belt\Content\Services\MoveService::log
     */
    public function test()
    {
        $service = new MoveService();

        # construct
        //$this->assertInstanceOf(Attachment::class, $service->attachments);

        # adapter
        //$this->assertInstanceOf(LocalAdapter::class, $service->adapter('foo'));

        # log
        $path = sprintf('storage/logs/moved-files/%s.log', date('Y-m-d'));
        $service->disk = m::mock(Filesystem::class);
        $service->disk->shouldReceive('append')->once()->with($path, 'test')->andReturnSelf();
        $service->log('test');
    }

    /**
     * @covers \Belt\Content\Services\MoveService::run
     */
    public function testRun()
    {
        $options = [
            'ids' => '1,2',
            'limit' => 1,
            'queue' => false,
        ];

        $attachment = factory(Attachment::class)->make();
        $attachments = new Collection();
        $attachments->add($attachment);

        $qb = m::mock(Builder::class);
        $qb->shouldReceive('where')->with('driver', 'local')->andReturnSelf();
        $qb->shouldReceive('orderBy')->with('updated_at')->andReturnSelf();
        $qb->shouldReceive('whereIn')->with('id', [1, 2])->andReturnSelf();
        $qb->shouldReceive('take')->with(1)->andReturnSelf();
        $qb->shouldReceive('get')->andReturn($attachments);

        Morph::shouldReceive('type2QB')->with('attachments')->andReturn($qb);

        # run w/o queue
        $service = m::mock(MoveService::class . '[move]');
        $service->shouldReceive('move')->with($attachment, 'foo', $options)->andReturnSelf();
        $service->run('local', 'foo', $options);

        # run w/queue
        \Queue::fake();
        $options['queue'] = true;
        $service = m::mock(MoveService::class . '[move]');
        $service->run('local', 'foo', $options);

        Queue::assertPushed(MoveAttachment::class, function ($job) use ($attachment) {
            return $job->attachment == $attachment;
        });
    }

    /**
     * @covers \Belt\Content\Services\MoveService::move
     */
    public function testMove()
    {
        $service = new MoveService();

        $source_driver = 'foo';
        $target_driver = 'bar';
        $options = [
            'ids' => '1,2',
            'limit' => '100',
        ];

        Attachment::unguard();
        $attachments = new Collection();

        /* @var $attachment , $data Attachment */
        $data = factory(Attachment::class)->make([
            'driver' => 'foo',
            'path' => __DIR__ . '/../../assets/test.jpg',
            'name' => 'test.jpg',
        ]);
        $data->setRelations([]);
        $attachment = m::mock(Attachment::class . '[getContentsAttribute,update,touch,toArray]');
        $attachment->shouldReceive('getContentsAttribute')->andReturn('contents');
        $attachment->shouldReceive('update')->andReturnSelf();
        $attachment->shouldReceive('touch')->andReturnSelf();
        $attachment->shouldReceive('toArray')->andReturn($data->toArray());
        $attachments->add($attachment);

        $data = factory(Attachment::class)->make([
            'driver' => 'foo',
            'path' => __DIR__ . '/../../assets/test.jpg',
            'name' => 'test.jpg',
        ]);
        $data->setRelations([]);
        $attachment = m::mock(Attachment::class . '[getContentsAttribute,update,touch,toArray]');
        $attachment->name = 'foo.jpg';
        $attachment->shouldReceive('getContentsAttribute')->andReturn('contents');
        $attachment->shouldReceive('update')->andReturnSelf();
        $attachment->shouldReceive('touch')->andReturnSelf();
        $attachment->shouldReceive('toArray')->andReturn($data->toArray());
        $attachments->add($attachment);

        $qb = m::mock(Builder::class);
        $qb->shouldReceive('where')->with('driver', $source_driver)->andReturnSelf();
        $qb->shouldReceive('orderBy')->with('updated_at')->andReturnSelf();
        $qb->shouldReceive('take')->with(100)->andReturnSelf();
        $qb->shouldReceive('whereIn')->with('id', [1, 2])->andReturnSelf();
        $qb->shouldReceive('get')->andReturn($attachments);
        $service->attachments = $qb;

        $service->disk = m::mock(Filesystem::class);
        $service->disk->shouldReceive('append')->withAnyArgs()->andReturnSelf();

        # good move
        $adapter = m::mock(BaseAdapter::class);
        $adapter->shouldReceive('mergeConfig')->andReturnSelf();
        $adapter->shouldReceive('upload')->andReturn(['path' => 'new/path']);
        AdapterFactory::$adapters['foo'] = $adapter;
        $service->move($attachment, 'foo', $options);

        # bad move
        $adapter = m::mock(BaseAdapter::class);
        $adapter->shouldReceive('mergeConfig')->andReturnSelf();
        $adapter->shouldReceive('upload')->andReturn([]);
        AdapterFactory::$adapters['foo'] = $adapter;
        $service->move($attachment, 'foo', $options);

        # other bad move
        $adapter = m::mock(BaseAdapter::class);
        $adapter->shouldReceive('mergeConfig')->andReturnSelf();
        $adapter->shouldReceive('upload')->andThrow(new \Exception());
        AdapterFactory::$adapters['foo'] = $adapter;
        $service->move($attachment, 'foo', $options);
    }

}
