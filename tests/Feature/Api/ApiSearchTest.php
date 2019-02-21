<?php namespace Tests\Belt\Content\Feature\Api;

use Belt\Core\Tests;

class ApiSearchTest extends Tests\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/search?include=pages');
        $response->assertStatus(200);

        # index (invalid engine)
        $response = $this->json('GET', '/api/v1/search?engine=invalid');
        $response->assertStatus(404);

        # index (valid non-local engine)
        $response = $this->json('GET', '/api/v1/search?engine=mock');
        $response->assertStatus(200);
    }

}