<?php

use Belt\Core\Testing;
use Belt\Core\User;
use Belt\Content\Page;

class CompilerFunctionalTest extends Testing\BeltTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->refreshDB();
        Page::unguard();
        $page = Page::find(1);
        $page->update(['is_active' => true]);
    }

    public function testAsAnonymousUser()
    {
        app()['config']->set('belt.subtypes.pages.default.force_compile', true);

        # show forces compile for template
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);
    }

    public function testAsSuper()
    {
        $this->actAsSuper();

        # show compiles b/c debug env
        putenv("APP_DEBUG=true");
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);

        # show compiles b/c acting as super
        putenv("APP_DEBUG=false");
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);

    }

    public function testAsLoggedInUser()
    {
        # show caches b/c logged in user does not own page
        putenv("APP_DEBUG=false");
        $this->actingAs(factory(User::class)->make(['is_super' => false]));
        $response = $this->json('GET', '/pages/1');
        $response->assertStatus(200);
    }

}