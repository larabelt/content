<?php

use Belt\Content\Http\Requests\UpdateList;

class UpdateListTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateList::rules
     */
    public function test()
    {

        $request = new UpdateList();

        $this->assertNotEmpty($request->rules());
    }

}