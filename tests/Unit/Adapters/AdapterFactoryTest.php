<?php namespace Tests\Belt\Content\Unit\Adapters;

use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Adapters\BaseAdapter;
use Belt\Content\Adapters\AdapterFactory;
use Belt\Content\Adapters\LocalAdapter;

class AdapterFactoryTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Adapters\AdapterFactory::up
     * @covers \Belt\Content\Adapters\AdapterFactory::getDefaultDriver
     */
    public function test()
    {
        app()['config']->set('belt.content.drivers.AdapterFactoryTest', [
            'disk' => 'public',
            'adapter' => LocalAdapter::class,
            'prefix' => 'testing',
            'src' => [
                'root' => 'http://localhost',
            ],
            'secure' => [
                'root' => 'http://localhost',
            ],
        ]);

        $this->assertEmpty(array_get(AdapterFactory::$adapters, 'AdapterFactoryTest'));
        $this->assertInstanceOf(BaseAdapter::class, AdapterFactory::up('AdapterFactoryTest'));
        $this->assertNotEmpty(AdapterFactory::$adapters);
        $this->assertInstanceOf(BaseAdapter::class, AdapterFactory::up('AdapterFactoryTest'));

        try {
            $exception = false;
            AdapterFactory::up('invalid');
        } catch (\Exception $e) {
            $exception = true;
        }
        $this->assertTrue($exception);

        # default
        app()['config']->set('belt.content', []);
        $this->assertEquals('default', AdapterFactory::getDefaultDriver());
        app()['config']->set('belt.content.drivers', ['foo' => ['stuff']]);
        $this->assertEquals('foo', AdapterFactory::getDefaultDriver());
        app()['config']->set('belt.content.drivers', ['default' => ['stuff']]);
        $this->assertEquals('default', AdapterFactory::getDefaultDriver());
        app()['config']->set('belt.content.default_driver', 'bar');
        $this->assertEquals('bar', AdapterFactory::getDefaultDriver());

    }

}