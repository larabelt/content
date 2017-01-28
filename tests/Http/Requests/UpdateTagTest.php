<?php

use Ohio\Content\Http\Requests\UpdateTag;

class UpdateTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\UpdateTag::rules
     */
    public function test()
    {

        $request = new UpdateTag();

        $this->assertNotEmpty($request->rules());
    }

}