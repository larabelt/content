<?php

use Ohio\Content\Block\Http\Requests\CreateRequest;

class CreateRequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Block\Http\Requests\CreateRequest::rules
     */
    public function test()
    {

        $request = new CreateRequest();

        $this->assertNotEmpty($request->rules());
    }

}