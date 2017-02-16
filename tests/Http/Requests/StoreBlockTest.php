<?php

use Belt\Content\Http\Requests\StoreBlock;

class StoreBlockTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreBlock::rules
     */
    public function test()
    {

        $request = new StoreBlock();

        $this->assertNotEmpty($request->rules());
    }

}