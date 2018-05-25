<?php

use Belt\Spot\Http\Requests\StoreList;

class StoreListTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Spot\Http\Requests\StoreList::rules
     */
    public function test()
    {

        $request = new StoreList();

        $this->assertNotEmpty($request->rules());
    }

}