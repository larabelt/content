<?php

use Belt\Spot\Http\Requests\StoreListable;

class StoreListableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Spot\Http\Requests\StoreListable::rules
     */
    public function test()
    {

        $request = new StoreListable();

        $this->assertNotEmpty($request->rules());
    }

}