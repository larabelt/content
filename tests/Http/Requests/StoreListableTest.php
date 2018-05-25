<?php

use Belt\Content\Http\Requests\StoreListable;

class StoreListableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreListable::rules
     */
    public function test()
    {

        $request = new StoreListable();

        $this->assertNotEmpty($request->rules());
    }

}