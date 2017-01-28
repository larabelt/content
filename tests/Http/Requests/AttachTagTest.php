<?php

use Ohio\Content\Http\Requests\AttachTag;

class AttachTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\AttachTag::rules
     */
    public function test()
    {

        $request = new AttachTag();

        $this->assertNotEmpty($request->rules());
    }

}