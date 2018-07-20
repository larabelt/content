<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Handle;
use Belt\Content\Http\Requests\UpdateHandle;

class UpdateHandleTest extends Testing\BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\UpdateHandle::rules
     */
    public function test()
    {
        app()['config']->set('belt.subtypes.handles', [
            'default' => [
                'show_target' => true,
            ],
        ]);

        Handle::unguard();
        $handle = new Handle(['id' => 1]);

        $request = m::mock(UpdateHandle::class . '[get, route]');
        $request->shouldReceive('get')->withArgs(['subtype', 'default'])->andReturn('default');
        $request->shouldReceive('route')->with('handle')->andReturn($handle);

        $this->assertNotEmpty($request->rules());
    }

}