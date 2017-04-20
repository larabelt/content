<?php

use Belt\Core\Testing;

class WebPagesFunctionalTest extends Testing\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # show
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);
    }

}