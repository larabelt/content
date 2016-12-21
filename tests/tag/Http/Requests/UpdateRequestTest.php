<?php

use Ohio\Content\Tag\Http\Requests\UpdateRequest;

class UpdateRequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Tag\Http\Requests\UpdateRequest::rules
     */
    public function test()
    {

        $request = new UpdateRequest();

        $this->assertNotEmpty($request->rules());
    }

}