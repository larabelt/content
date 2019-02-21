<?php namespace Tests\Belt\Content\Feature\Api;

use Belt\Core\Tests;

class ApiListItemFunctionalTest extends Tests\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/lists/1/items');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/lists/1/items', [
            'subtype' => 'pages',
        ]);
        $response->assertStatus(201);
        $listableID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/lists/1/items/$listableID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/lists/1/items/$listableID");
        $response = $this->json('GET', "/api/v1/lists/1/items/$listableID");
        //$response->assertJson(['heading' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/lists/1/items/$listableID");

        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/lists/1/items/$listableID");
        $response->assertStatus(404);
    }

}