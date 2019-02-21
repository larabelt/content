<?php namespace Tests\Belt\Content\Feature\Web;

use Belt\Core\Tests;
use Belt\Content\Page;

class WebPagesFunctionalTest extends Tests\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();

        Page::unguard();
        $page = Page::find(1);

        # show
        $page->update(['is_active' => true]);
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);

        # show (404)
        $page->update(['is_active' => false]);
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(404);

        # show (super, avoid 404)
        $this->actAsSuper();
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);
    }

}