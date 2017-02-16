<?php

use Belt\Content\Http\Requests\UpdateHandle;

class UpdateHandleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateHandle::rules
     */
    public function test()
    {

        $request = new UpdateHandle();

        $this->assertNotEmpty($request->rules());
    }

}