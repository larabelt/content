<?php

use Ohio\Content\Http\Requests\StoreHandle;

class StoreHandleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\StoreHandle::rules
     */
    public function test()
    {

        $request = new StoreHandle();

        $this->assertNotEmpty($request->rules());
    }

}