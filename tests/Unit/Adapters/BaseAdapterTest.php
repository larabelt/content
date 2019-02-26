<?php namespace Tests\Belt\Content\Unit\Adapters;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Attachment;
use Belt\Content\Adapters\BaseAdapter;
use Belt\Content\Adapters\LocalAdapter;
use Belt\Content\Helpers\SrcHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\FilesystemAdapter;

class BaseAdapterTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Adapters\BaseAdapter::__construct
     * @covers \Belt\Content\Adapters\BaseAdapter::config
     * @covers \Belt\Content\Adapters\BaseAdapter::randomFilename
     * @covers \Belt\Content\Adapters\BaseAdapter::normalizePath
     * @covers \Belt\Content\Adapters\BaseAdapter::prefixedPath
     * @covers \Belt\Content\Adapters\BaseAdapter::__create
     * @covers \Belt\Content\Adapters\BaseAdapter::loadMacros
     *
     * @covers \Belt\Content\Adapters\BaseAdapter::src
     * @covers \Belt\Content\Adapters\BaseAdapter::secure
     * @covers \Belt\Content\Adapters\BaseAdapter::contents
     * @covers \Belt\Content\Adapters\BaseAdapter::upload
     * @covers \Belt\Content\Adapters\BaseAdapter::getFromPath
     */
    public function test()
    {
        $attachment = factory(Attachment::class)->make();
        $attachment->name = 'test.jpg';
        $attachment->attachment_path = 'public/images/test.jpg';
        $attachment->web_path = 'images/test.jpg';

        $attachmentInfo = new UploadedFile(__DIR__ . '/../../assets/test.jpg', 'test.jpg');

        app()['config']->set('belt.content.drivers.BaseAdapterTest', [
            'disk' => 'public',
            'adapter' => LocalAdapter::class,
            'prefix' => 'assets',
            'src' => [
                'root' => 'http://localhost',
            ],
            'secure' => [
                'root' => 'http://localhost',
            ],
        ]);

        # construct
        $exception = false;
        try {
            new BaseAdapterTestStub('MissingDiskBaseAdapterTest');
        } catch (\Exception $e) {
            $exception = true;
        };
        $this->assertTrue($exception);

        $adapter = new BaseAdapterTestStub('BaseAdapterTest');
        $this->assertNotNull($adapter->driver);
        $this->assertNotNull($adapter->disk);
        $this->assertNotEmpty($adapter->config);

        # loadMacros
        $this->assertEquals('test', SrcHelper::baseAdapterTestStub());

        # config
        $adapter->config = array_merge($adapter->config, ['foo' => 'bar']);
        $this->assertEquals('bar', $adapter->config('foo'));
        $this->assertEquals('default', $adapter->config('missing', 'default'));
        $this->assertEquals($adapter->config, $adapter->config());

        # randomFilename
        $randomFilename = $adapter->randomFilename($attachmentInfo);
        $randomFilename = explode('.', $randomFilename);
        $this->assertEquals(2, count($randomFilename));
        $this->assertTrue(in_array($randomFilename[1], ['jpg', 'jpeg']));
        $fileInfo = m::mock(UploadedFile::class);
        $fileInfo->shouldReceive('guessExtension')->once()->andReturn('jpg');
        $this->assertTrue(str_contains($adapter->randomFilename($fileInfo), ['.jpg', date('Ymd')]));

        # randomFilename (part 2)
        $uploadedFile = m::mock(UploadedFile::class . '[guessExtension]', [__DIR__ . '/../../assets/test.jpg', 'test.jpg']);
        $uploadedFile->shouldReceive('guessExtension')->andReturn('bin');
        $this->assertContains('.jpg', $adapter->randomFilename($uploadedFile));

        # normalizePath
        $this->assertEquals('test', $adapter->normalizePath('test'));
        $this->assertEquals('test', $adapter->normalizePath('test/'));
        $this->assertEquals('test', $adapter->normalizePath('/test'));
        $this->assertEquals('test', $adapter->normalizePath('/test/'));
        $this->assertEquals('test/test', $adapter->normalizePath('/test/test/'));
        $this->assertEquals('test/test', $adapter->normalizePath('/test//test/'));
        $this->assertEquals('test/test', $adapter->normalizePath(['test', 'test']));

        # prefixedPath
        $this->assertEquals('assets/test/test.jpg', $adapter->prefixedPath('/test/', $attachment->name));

        # __create
        $sizes = getimagesize($attachmentInfo->getRealPath());
        $data = $adapter->__create('assets/test', $attachmentInfo, $attachment->name);
        $this->assertEquals($adapter->driver, $data['driver']);
        $this->assertEquals($attachment->name, $data['name']);
        $this->assertEquals($attachmentInfo->getFilename(), $data['original_name']);
        $this->assertEquals('assets/test', $data['path']);
        $this->assertEquals($attachmentInfo->getSize(), $data['size']);
        $this->assertEquals($attachmentInfo->getMimeType(), $data['mimetype']);
        $this->assertEquals($sizes[0], $data['width']);
        $this->assertEquals($sizes[1], $data['height']);

        # __create (part 2)
        $uploadedFile = m::mock(UploadedFile::class . '[getMimeType,getClientMimeType]', [__DIR__ . '/../../assets/test.jpg', 'test.jpg']);
        $uploadedFile->shouldReceive('getMimeType')->andReturn('application/octet-stream');
        $uploadedFile->shouldReceive('getClientMimeType')->andReturn('foo');
        $data = $adapter->__create('assets/test', $uploadedFile);
        $this->assertEquals('foo', $data['mimetype']);

        # tests moved from LocalAdapter
        app()['config']->set('filesystems.disks.LocalAdapterTest', [
            'driver' => 'local',
            'root' => __DIR__ . '/../../',
        ]);

        app()['config']->set('belt.content.drivers.LocalAdapterTest', [
            'disk' => 'LocalAdapterTest',
            'adapter' => LocalAdapter::class,
            'prefix' => 'assets',
            'src' => [
                'root' => 'http://localhost/images',
            ],
            'secure' => [
                'root' => 'https://localhost/images',
            ],
        ]);

        $attachment = factory(Attachment::class)->make();
        $attachment->name = 'test.jpg';
        $attachment->path = 'assets';

        $attachmentInfo = new UploadedFile(__DIR__ . '/../../assets/test.jpg', 'test.jpg');

        # construct
        $adapter = new LocalAdapter('LocalAdapterTest');
        $this->assertNotNull($adapter->driver);
        $this->assertNotNull($adapter->disk);
        $this->assertNotEmpty($adapter->config);

        # src
        $this->assertEquals('http://localhost/images/assets/test.jpg', $adapter->src($attachment));

        # secure
        $this->assertEquals('https://localhost/images/assets/test.jpg', $adapter->secure($attachment));

        # secure
        $this->assertNotEmpty($adapter->contents($attachment));

        # upload
        $disk = m::mock(FilesystemAdapter::class);
        $disk->shouldReceive('putFileAs')->once()->with('assets/test', $attachmentInfo, 'test.jpg')->andReturn(true);
        $disk->shouldReceive('putFileAs')->once()->with('assets/test', $attachmentInfo, 'invalid.jpg')->andReturn(false);
        $adapter->disk = $disk;
        $this->assertNotEmpty($adapter->upload('test', $attachmentInfo, 'test.jpg'));
        $this->assertNull($adapter->upload('test', $attachmentInfo, 'invalid.jpg'));

        # __create
        $sizes = getimagesize($attachmentInfo->getRealPath());
        $data = $adapter->__create('assets/test', $attachmentInfo, $attachment->name);
        $this->assertEquals('LocalAdapterTest', $data['driver']);
        $this->assertEquals($attachment->name, $data['name']);
        $this->assertEquals($attachmentInfo->getFilename(), $data['original_name']);
        $this->assertEquals('assets/test', $data['path']);
        $this->assertEquals($attachmentInfo->getSize(), $data['size']);
        $this->assertEquals($attachmentInfo->getMimeType(), $data['mimetype']);
        $this->assertEquals($sizes[0], $data['width']);
        $this->assertEquals($sizes[1], $data['height']);

        # getFromPath
        $disk = m::mock(FilesystemAdapter::class);
        $disk->shouldReceive('exists')->once()->with('assets/test.jpg')->andReturn(true);
        $disk->shouldReceive('exists')->once()->with('assets/invalid.jpg')->andReturn(false);
        $adapter->disk = $disk;
        $result = $adapter->getFromPath('assets', 'test.jpg');
        $this->assertNotEmpty($result);
        $result = $adapter->getFromPath('assets', 'invalid.jpg');
        $this->assertEmpty($result);

    }

    /**
     * @covers \Belt\Content\Adapters\BaseAdapter::__construct
     * @covers \Belt\Content\Adapters\BaseAdapter::contents
     */
    public function testMacroContent()
    {
        app()['config']->set('belt.content.drivers.BaseAdapterTest', [
            'disk' => 'public',
            'adapter' => LocalAdapter::class,
            'prefix' => 'assets',
            'src' => [
                'root' => 'http://localhost',
            ],
            'secure' => [
                'root' => 'http://localhost',
            ],
            'macros' => [
                'contents' => function ($adapter, $attachment) {
                    return $attachment->foo;
                }
            ]
        ]);

        $adapter = new BaseAdapterTestStub('BaseAdapterTest');

        $attachment = factory(Attachment::class)->make();
        $attachment->foo = 'bar';

        $this->assertEquals('bar', $adapter->contents($attachment));

    }
}

class BaseAdapterTestStub extends BaseAdapter
{
    public static function loadMacros($driver)
    {
        SrcHelper::macro('baseAdapterTestStub', function () {
            return 'test';
        });
    }
}