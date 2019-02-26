<?php namespace Tests\Belt\Content\Unit\Services\Cloudinary;

use Mockery as m;
use Illuminate\Support\Facades\Storage;
use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Services\Cloudinary\CloudinaryServiceProvider;

class CloudinaryServiceProviderTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryServiceProvider::register
     * @covers \Belt\Content\Services\Cloudinary\CloudinaryServiceProvider::boot
     */
    public function test()
    {
        Storage::shouldReceive('extend')->with('cloudinary',
            m::on(function (\Closure $closure) {
                $app = app();
                $closure($app, []);
                return is_callable($closure);
            })
        );

        $provider = new CloudinaryServiceProvider(app());
        $provider->register();
        $provider->boot();
    }

}
