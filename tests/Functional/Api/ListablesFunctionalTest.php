<?php

use Belt\Core\Testing;

class ApiListablesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/itineraries/1/places');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/itineraries/1/places', [
            'place_id' => 10,
            'heading' => 'test',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $placeID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/itineraries/1/places/$placeID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/itineraries/1/places/$placeID", ['heading' => 'updated']);
        $response = $this->json('GET', "/api/v1/itineraries/1/places/$placeID");
        $response->assertJson(['heading' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/itineraries/1/places/$placeID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/itineraries/1/places/$placeID");
        $response->assertStatus(404);
    }

}