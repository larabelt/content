<?php namespace Tests\Belt\Content\Unit\Adapters;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Attachment;
use Belt\Content\Adapters\CloudinaryAdapter;
use Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\FilesystemAdapter;


class CloudinaryAdapterTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::src
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::secure
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::upload
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::__create
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::getFromPath
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::diskAdapter
     * @covers \Belt\Content\Adapters\CloudinaryAdapter::contents
     */
    public function test()
    {
        app()['config']->set('filesystems.disks.CloudinaryAdapterTest', [
            'driver' => 'local',
            'root' => __DIR__ . '/../../',
        ]);

        app()['config']->set('belt.content.drivers.CloudinaryAdapterTest', [
            'disk' => 'CloudinaryAdapterTest',
            'adapter' => CloudinaryAdapter::class,
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

        $attachmentInfo = new UploadedFile(__DIR__ . '/test.jpg', 'test.jpg');

        $adapter = new CloudinaryAdapter('CloudinaryAdapterTest');

        # src
        $this->assertEquals('http://localhost/images/assets/test.jpg', $adapter->src($attachment));

        # secure
        $this->assertEquals('https://localhost/images/assets/test.jpg', $adapter->secure($attachment));

        # secure
        $this->assertNotEmpty($adapter->contents($attachment));

        # upload
        $adapter = m::mock(CloudinaryAdapter::class . '[__create]', ['CloudinaryAdapterTest']);
        $adapter->shouldReceive('__create')->andReturn(true);
        $adapter->disk = m::mock(FilesystemAdapter::class);
        $adapter->disk->shouldReceive('putFileAs')->andReturn(true);
        $this->assertNotEmpty($adapter->upload('test', $attachmentInfo, 'test.jpg'));

        # upload (fail)
        $adapter = new CloudinaryAdapter('CloudinaryAdapterTest');
        $adapter->disk = m::mock(FilesystemAdapter::class);
        $adapter->disk->shouldReceive('putFileAs')->andReturn(false);
        $this->assertNull($adapter->upload('test', $attachmentInfo, 'invalid.jpg'));

        # __create
        $diskAdapter = m::mock(CloudinaryFlysystemAdapter::class);
        $diskAdapter->shouldReceive('getResponse')->andReturn([
            'rel_path' => 'assets/test',
            'basename' => 'test.jpg',
        ]);
        $adapter = new CloudinaryAdapter('CloudinaryAdapterTest');
        $adapter->diskAdapter = $diskAdapter;
        $sizes = getimagesize($attachmentInfo->getRealPath());
        $data = $adapter->__create('assets/test', $attachmentInfo, $attachment->name);
        $this->assertEquals('CloudinaryAdapterTest', $data['driver']);
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

        # contents
        $adapter = new CloudinaryAdapter('CloudinaryAdapterTest');
        $adapter->disk = m::mock(FilesystemAdapter::class);
        $adapter->disk->shouldReceive('get')->once()->with($attachment->rel_path);
        $adapter->contents($attachment);
    }

}