<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\UpdatePost;

class UpdatePostTest extends \PHPUnit\Framework\TestCase
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