<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Attachment;
use Belt\Content\Adapters\S3LambdaAdapter;
use Belt\Content\Helpers\ClipHelper;
use Belt\Content\Helpers\SrcHelper;

class S3LambdaAdapterTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Adapters\S3LambdaAdapter::loadMacros
     */
    public function test()
    {
        app()['config']->set('belt.content.drivers.S3LambdaAdapterTest', [
            'disk' => 's3',
            'adapter' => S3LambdaAdapter::class,
            'prefix' => 'testing',
            'src' => [
                'root' => 'http://localhost/images',
            ],
            'secure' => [
                'root' => 'https://localhost/images',
            ],
        ]);

        # loadMacros
        S3LambdaAdapter::loadMacros('S3LambdaAdapterTest');
        $this->assertTrue(SrcHelper::hasMacro('S3LambdaAdapterTest'));

        # closure
        $attachment = factory(Attachment::class)->make([
            'driver' => 'S3LambdaAdapterTest',
            'name' => 'test.jpg',
            'path' => 'testing',
            'width' => 400,
            'height' => 300,
        ]);

        $ClipHelper = new ClipHelper($attachment);

        $this->assertEquals('//localhost/images/100x100/testing/test.jpg', $ClipHelper->src(100, 100));
        $this->assertEquals('//localhost/images/100x75/testing/test.jpg', $ClipHelper->src(100));
        $this->assertEquals('//localhost/images/133x100/testing/test.jpg', $ClipHelper->src(null, 100));
    }

}