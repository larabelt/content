<?php

use Belt\Spot\Http\Requests\UpdateList;

class UpdateListTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Spot\Http\Requests\UpdateList::rules
     */
    public function test()
    {

        $request = new UpdateList();

        $this->assertNotEmpty($request->rules());
    }

}