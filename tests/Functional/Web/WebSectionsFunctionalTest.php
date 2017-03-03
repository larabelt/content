<?php

use Belt\Core\Testing;

class WebSectionsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/sections/1/preview');
        $response->assertStatus(200);
    }

}