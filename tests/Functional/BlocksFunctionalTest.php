<?php

use Ohio\Core\Testing;

class BlocksFunctionalTest extends Testing\OhioTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/blocks');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/blocks', [
            'name' => 'test',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $blockID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/blocks/$blockID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/blocks/$blockID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/blocks/$blockID");
        $response->assertJson(['name' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/blocks/$blockID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/blocks/$blockID");
        $response->assertStatus(404);
    }

}