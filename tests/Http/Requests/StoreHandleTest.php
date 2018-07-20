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

        app()['config']->set('belt.subtypes.handles', [
            'default' => [
                'show_target' => true,
            ],
        ]);

        $request = new StoreHandle(['subtype' => 'default']);

        $this->assertNotEmpty($request->rules());
    }

}