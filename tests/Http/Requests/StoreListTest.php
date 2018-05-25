<?php

use Belt\Content\Http\Requests\StoreList;

class StoreListTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreList::rules
     */
    public function test()
    {

        $request = new StoreList();

        $this->assertNotEmpty($request->rules());
    }

}