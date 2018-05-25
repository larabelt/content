<?php

use Belt\Spot\Http\Requests\UpdateItinerary;

class UpdateItineraryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Spot\Http\Requests\UpdateItinerary::rules
     */
    public function test()
    {

        $request = new UpdateItinerary();

        $this->assertNotEmpty($request->rules());
    }

}