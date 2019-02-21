<?php namespace Tests\Belt\Content\Feature\Web;

use Belt\Core\Tests;

class WebSearchFunctionalTest extends Tests\BeltTestCase
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