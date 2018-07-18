<?php

use Belt\Core\Testing;

class TermablesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/pages/1/terms');
        $response->assertStatus(200);

        # attach
        $response = $this->json('POST', '/api/v1/pages/1/terms', [
            'id' => 1
        ]);
        $response->assertStatus(201);
        $response->assertJsonFragment(['id' => 1]);
        $response = $this->json('GET', "/api/v1/pages/1/terms/1");
        $response->assertStatus(200);

        # show
        $response = $this->json('GET', "/api/v1/pages/1/terms/1");
        $response->assertStatus(200);

        # detach
        $response = $this->json('DELETE', "/api/v1/pages/1/terms/1");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/pages/1/terms/1");
        $response->assertStatus(404);
    }

}