<?php

use Belt\Core\Testing;

class WebPagesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/page/1');
        $response->assertStatus(200);

        $response = $this->json('GET', '/page/sectioned/preview');
        $response->assertStatus(200);
    }

}