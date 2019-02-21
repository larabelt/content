<?php namespace Tests\Belt\Content\Feature\Api;

use Belt\Core\Tests;

class ApiHandleablesTest extends Tests\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/pages/1/handles');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/pages/1/handles', [
            'handleable_id' => 1,
            'handleable_type' => 'pages',
            'url' => 'test',
        ]);
        $response->assertStatus(201);
        $handleID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/pages/1/handles/$handleID");
        $response->assertStatus(200);

        $response = $this->json('GET', "/api/v1/pages/2/handles/$handleID");
        $response->assertStatus(404);

        # update
        $response = $this->json('PUT', "/api/v1/pages/1/handles/$handleID", [
            'url' => '/updated'
        ]);
        $response = $this->json('GET', "/api/v1/pages/1/handles/$handleID");
        $response->assertJson(['url' => '/updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/pages/1/handles/$handleID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/pages/1/handles/$handleID");
        $response->assertStatus(404);
    }

}