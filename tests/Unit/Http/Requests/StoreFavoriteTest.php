<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\StoreFavorite;

class StoreFavoriteTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreFavorite::rules
     */
    public function test()
    {

        $request = new StoreFavorite();

        $this->assertNotEmpty($request->rules());
    }

}