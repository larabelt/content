<?php

use Belt\Core\Testing;
use Belt\Content\Page;

class WebPagesFunctionalTest extends Testing\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();
        $this->actAsSuper();

        Page::unguard();
        $page = Page::find(1);
        $page->update(['is_active' => true]);

        # show
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);

        $page->update(['is_active' => false]);

        # show (404)
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(404);
    }

}