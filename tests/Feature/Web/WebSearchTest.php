<?php namespace Tests\Belt\Content\Feature\Web;

use Tests\Belt\Core;

class WebSearchTest extends \Tests\Belt\Core\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/search?include=pages');
        $response->assertStatus(200);
    }

}