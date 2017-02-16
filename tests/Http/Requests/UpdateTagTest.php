<?php

use Belt\Content\Http\Requests\UpdateTag;

class UpdateTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateTag::rules
     */
    public function test()
    {

        $request = new UpdateTag();

        $this->assertNotEmpty($request->rules());
    }

}