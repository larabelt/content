<?php

use Ohio\Content\Http\Requests\StoreTag;

class StoreTagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\StoreTag::rules
     */
    public function test()
    {

        $request = new StoreTag();

        $this->assertNotEmpty($request->rules());
    }

}