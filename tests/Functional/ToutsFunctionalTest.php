<?php

use Ohio\Core\Testing;

class ToutsFunctionalTest extends Testing\OhioTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/touts');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/touts', [
            'name' => 'test',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $toutID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/touts/$toutID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/touts/$toutID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/touts/$toutID");
        $response->assertJson(['name' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/touts/$toutID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/touts/$toutID");
        $response->assertStatus(404);
    }

}