<?php

use Belt\Core\Testing;

use Belt\Spot\Itinerary;

class ApiItinerariesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/itineraries');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/itineraries', [
            'name' => 'test',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $itineraryID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/itineraries/$itineraryID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/itineraries/$itineraryID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/itineraries/$itineraryID");
        $response->assertJson(['name' => 'updated']);

        # copy
        Itinerary::unguard();
        $old = Itinerary::find($itineraryID);
        $old->sections()->create(['sectionable_type' => 'sections']);
        $old->attachments()->attach(1);
        $old->categories()->attach(1);
        $old->itineraryPlaces()->create([
            'place_id' => 1,
        ]);
        $old->tags()->attach(1);
        $old->handles()->create(['url' => '/copied-itinerary']);
        $response = $this->json('POST', '/api/v1/itineraries', ['source' => $itineraryID]);
        $response->assertStatus(201);
        $copiedItineraryID = array_get($response->json(), 'id');
        $response = $this->json('GET', "/api/v1/itineraries/$copiedItineraryID");
        $response->assertStatus(200);

        # delete
        $response = $this->json('DELETE', "/api/v1/itineraries/$itineraryID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/itineraries/$itineraryID");
        $response->assertStatus(404);
    }

}