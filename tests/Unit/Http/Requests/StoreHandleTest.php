<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Core\Tests;
use Belt\Content\Http\Requests\StoreHandle;

class StoreHandleTest extends Tests\BeltTestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreHandle::rules
     */
    public function test()
    {

        app()['config']->set('belt.subtypes.handles', [
            'default' => [
                'show_target' => true,
            ],
        ]);

        $request = new StoreHandle(['subtype' => 'default']);

        $this->assertNotEmpty($request->rules());
    }

}