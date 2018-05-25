<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Spot\Itinerary;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItineraryTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Spot\Itinerary::places
     * @covers \Belt\Spot\Itinerary::listables
     * @covers \Belt\Spot\Itinerary::toSearchableArray
     */
    public function test()
    {
        $itinerary = new Itinerary();

        # places
        $this->assertInstanceOf(HasMany::class, $itinerary->places());

        # listables
        $this->assertInstanceOf(HasMany::class, $itinerary->listables());

        # toSearchableArray
        $this->assertNotEmpty($itinerary->toSearchableArray());
    }

}