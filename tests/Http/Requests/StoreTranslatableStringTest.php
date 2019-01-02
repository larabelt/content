<?php

use Belt\Content\Http\Requests\StoreTranslatableString;

class StoreTranslatableStringTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreTranslatableString::rules
     */
    public function test()
    {

        $request = new StoreTranslatableString();

        $this->assertNotEmpty($request->rules());
    }

}