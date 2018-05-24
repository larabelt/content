<?php

use Belt\Content\Http\Requests\StoreBlock;

class StoreBlockTest extends \PHPUnit\Framework\TestCase
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