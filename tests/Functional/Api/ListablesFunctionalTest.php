<?php

use Belt\Core\Testing;

class ApiListablesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/lists/1/listables');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/lists/1/listables', [
            'listable_type' => 'pages',
            'listable_id' => 10,
        ]);
        $response->assertStatus(201);
        $listableID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/lists/1/listables/$listableID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/lists/1/listables/$listableID");
        $response = $this->json('GET', "/api/v1/lists/1/listables/$listableID");
        //$response->assertJson(['heading' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/lists/1/listables/$listableID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/lists/1/listables/$listableID");
        $response->assertStatus(404);
    }

}