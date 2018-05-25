<?php

use Belt\Core\Testing;
use Belt\Spot\Itinerary;

class WebItinerariesFunctionalTest extends Testing\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();

        Itinerary::unguard();
        $itinerary = Itinerary::find(1);

        # show
        $itinerary->update(['is_active' => true]);
        $response = $this->json('GET', '/itineraries/1');
        $response->assertStatus(200);

        # show (404)
        $itinerary->update(['is_active' => false]);
        $response = $this->json('GET', '/itineraries/1');
        $response->assertStatus(404);

        # show (super, avoid 404)
        $this->actAsSuper();
        $response = $this->json('GET', '/itineraries/1');
        $response->assertStatus(200);
    }

}