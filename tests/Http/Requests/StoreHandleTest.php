<?php

use Belt\Core\Testing;
use Belt\Content\Http\Requests\StoreHandle;

class StoreHandleTest extends Testing\BeltTestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreHandle::rules
     */
    public function test()
    {

        app()['config']->set('belt.content.handles.responses', [
            'default' => [
                'show_target' => true,
            ],
        ]);

        $request = new StoreHandle(['config_name' => 'default']);

        $this->assertNotEmpty($request->rules());
    }

}