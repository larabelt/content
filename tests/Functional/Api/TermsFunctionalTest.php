<?php

use Belt\Core\Testing;

class TermsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/terms');
        $response->assertStatus(200);


        # store
        $response = $this->json('POST', '/api/v1/terms', [
            'name' => 'test',
        ]);
        $response->assertStatus(201);
        $response->assertJsonFragment(['name' => 'test']);
        $termID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/terms/$termID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/terms/$termID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/terms/$termID");
        $response->assertJson(['name' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/terms/$termID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/terms/$termID");
        $response->assertStatus(404);
    }

}