<?php

use Belt\Core\Testing;

class SearchFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/search?include=pages');
        $response->assertStatus(200);
    }

}