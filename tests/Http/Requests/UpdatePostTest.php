<?php

use Belt\Content\Http\Requests\UpdatePost;

class UpdatePostTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdatePost::rules
     */
    public function test()
    {

        $request = new UpdatePost();

        $this->assertNotEmpty($request->rules());
    }

}