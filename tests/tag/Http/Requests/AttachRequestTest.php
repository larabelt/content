<?php

use Ohio\Content\Tag\Http\Requests\AttachRequest;

class AttachRequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Tag\Http\Requests\AttachRequest::rules
     */
    public function test()
    {

        $request = new AttachRequest();

        $this->assertNotEmpty($request->rules());
    }

}