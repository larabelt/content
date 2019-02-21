<?php namespace Tests\Belt\Content\Unit\Services\Cloudinary;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter;
use League\Flysystem\Config;


class CloudinaryFlysystemAdapterTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::__construct
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::write
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::writeStream
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::update
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::updateStream
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::rename
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::copy
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::delete
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::deleteDir
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::createDir
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::has
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::read
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::readStream
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::listContents
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::getMetadata
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::getSize
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::getMimetype
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::getTimestamp
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::upload
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::normalizeResponse
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::getResponse
     */
    public function test()
    {

        $path = __DIR__ . '/test.jpg';
        $fh = fopen($path, 'r');
        $contents = file_get_contents($path);

        # construct
        $adapter = new CloudinaryFlysystemAdapter([]);

        # response
        $adapter->response = ['test'];
        $this->assertEquals(['test'], $adapter->getResponse());

        # write / update
        $adapter = m::mock(CloudinaryFlysystemAdapter::class . '[upload]', [[]]);
        $adapter->shouldReceive('upload')->andReturn(true);
        $adapter->write('path/to/file', 'test', new Config());
        $adapter->writeStream('path/to/file', 'test', new Config());
        $adapter->update('path/to/file', 'test', new Config());
        $adapter->updateStream('path/to/file', 'test', new Config());

        # placeholders
        $adapter->rename('old/path/to/file', 'new/path/to/file');
        $adapter->copy('old/path/to/file', 'new/path/to/file');
        $adapter->delete('path/to/file');
        $adapter->createDir('path/to/file', new Config());
        $adapter->read('path/to/file');
        $adapter->readStream('path/to/file');
        $adapter->listContents('path/to/dir');
        $adapter->getMetadata('path/to/file');
        $adapter->getSize('path/to/file');
        $adapter->getMimetype('path/to/file');
        $adapter->getTimestamp('path/to/file');

        # deleteDir
        $adapter = m::mock(CloudinaryFlysystemAdapter::class . '[delete]', [[]]);
        $adapter->shouldReceive('delete')->andReturn(true);
        $adapter->deleteDir('path/to/file');

        # has
        $adapter = new CloudinaryFlysystemAdapter([]);
        $client = m::mock(\Cloudinary::class);
        $client->shouldReceive('cloudinary_url')->with('path/to/file')->andReturn(__DIR__ . '/test.jpg');
        $client->shouldReceive('cloudinary_url')->with('invalid/path/to/file')->andReturn(false);
        $adapter->client = $client;
        $this->assertTrue($adapter->has('path/to/file'));
        $this->assertFalse($adapter->has('invalid/path/to/file'));

        # read
        $adapter = new CloudinaryFlysystemAdapter([]);
        $adapter->read('path/to/file');
        $adapter = m::mock(CloudinaryFlysystemAdapter::class . '[readStream]', [[]]);
        $adapter->shouldReceive('readStream')->andReturn(['stream' => $fh]);
        $adapter->read('path/to/file');

        # upload
        $adapter = new CloudinaryFlysystemAdapter([]);
        $uploader = m::mock(\Cloudinary\Uploader::class);
        $uploader->shouldReceive('upload')->andReturn(['url' => 'http://cloudinary.com/something']);
        $adapter->uploader = $uploader;
        $adapter->upload('path/to/file', fopen($path, 'r'), 'test');
        $adapter->upload('path/to/file', $contents, 'test');

        # normalizeResponse
        $adapter = new CloudinaryFlysystemAdapter([]);
        $adapter->normalizeResponse([
            'url' => 'http://cloudinary.com/something'
        ]);

        # upload
        $adapter = new CloudinaryFlysystemAdapter([]);
        $uploader = m::mock(\Cloudinary\Uploader::class);
        $uploader->shouldReceive('upload')->andReturn(['url' => 'http://cloudinary.com/something']);
        $adapter->uploader = $uploader;
        $adapter->upload('path/to/file', $fh, 'test');
        $adapter->upload('path/to/file', $contents, 'test');

    }

    /**
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryFlysystemAdapter::upload
     */
    public function testUploadException()
    {
        # upload (exception)
        $adapter = new CloudinaryFlysystemAdapter([]);
        $adapter->uploader = m::mock(\Cloudinary\Uploader::class);
        $adapter->uploader->shouldReceive('upload')->once()->withAnyArgs()->andThrow(new \Exception());
        $adapter->upload('path/to/file', 'test', 'test');
    }

}
