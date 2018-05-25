<?php

use Belt\Spot\Http\Requests\StoreItineraryPlace;

class StoreItineraryPlaceTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Spot\Http\Requests\StoreItineraryPlace::rules
     */
    public function test()
    {

        $request = new StoreItineraryPlace();

        $this->assertNotEmpty($request->rules());
    }

}