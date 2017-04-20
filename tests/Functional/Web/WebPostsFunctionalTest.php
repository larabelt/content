<?php

use Belt\Core\Testing;

class WebPostsFunctionalTest extends Testing\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # show
        $response = $this->json('GET', '/posts/1');
        $response->assertStatus(200);

    }

}