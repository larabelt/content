<?php

use Belt\Content\Http\Requests\StoreFavorite;

class StoreFavoriteTest extends \PHPUnit_Framework_TestCase
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