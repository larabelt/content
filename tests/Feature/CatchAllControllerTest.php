<?php namespace Tests\Belt\Content\Feature;

use Belt\Core\Tests;
use Belt\Content\Page;

class CatchAllControllerTest extends Tests\BeltTestCase
{
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