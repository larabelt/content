<?php

use Belt\Core\Testing;

class PostsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/posts');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/posts', [
            'name' => 'test',
        ]);
        $response->assertStatus(201);
        $postID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/posts/$postID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/posts/$postID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/posts/$postID");
        $response->assertJson(['name' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/posts/$postID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/posts/$postID");
        $response->assertStatus(404);
    }

}