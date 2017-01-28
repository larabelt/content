<?php

use Ohio\Content\Http\Requests\StoreBlock;

class StoreBlockTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\StoreBlock::rules
     */
    public function test()
    {

        $request = new StoreBlock();

        $this->assertNotEmpty($request->rules());
    }

}