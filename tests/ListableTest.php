<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Spot\ItineraryPlace;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItineraryPlaceTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Spot\ItineraryPlace::place
     */
    public function test()
    {
        $itineraryPlace = new ItineraryPlace();

        # place
        $this->assertInstanceOf(BelongsTo::class, $itineraryPlace->place());
    }

}