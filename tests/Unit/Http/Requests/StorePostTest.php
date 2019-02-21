<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\StorePost;

class StorePostTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StorePost::rules
     */
    public function test()
    {

        $request = new StorePost();

        $this->assertNotEmpty($request->rules());
    }

}