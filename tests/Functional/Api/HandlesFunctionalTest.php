<?php

use Belt\Core\Testing;

class HandlesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/handles');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/handles', [
            'url' => 'test',
            'config_name' => 'not-found',
        ]);
        $response->assertStatus(201);
        $handleID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/handles/$handleID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/handles/$handleID", ['url' => 'updated']);
        $response = $this->json('GET', "/api/v1/handles/$handleID");
        $response->assertJson(['url' => '/updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/handles/$handleID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/handles/$handleID");
        $response->assertStatus(404);
    }

}