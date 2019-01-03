<?php

use Belt\Core\Testing;
use Belt\Core\User;
use Belt\Content\Page;

class CatchAllControllerFunctionalTest extends Testing\BeltTestCase
{
    public function tearDown()
    {
        //m::close();
    }

    /**
     * @covers \Belt\Content\Http\Controllers\CatchAllController::web
     */
    public function test()
    {
        $this->enableI18n();
        $this->refreshDB();

        Page::unguard();
        $page = Page::find(1);

        # show
        $page->update(['is_active' => true]);
        $response = $this->get("pages/" . $page->slug);
        $response->assertStatus(200);
    }

}