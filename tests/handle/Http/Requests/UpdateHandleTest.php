<?php

use Ohio\Content\Handle\Http\Requests\UpdateHandle;

class UpdateHandleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Handle\Http\Requests\UpdateHandle::rules
     */
    public function test()
    {

        $request = new UpdateHandle();

        $this->assertNotEmpty($request->rules());
    }

}