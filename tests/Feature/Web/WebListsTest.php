<?php namespace Tests\Belt\Content\Feature\Web;

use Tests\Belt\Core;
use Belt\Content\Lyst;

class WebListsTest extends \Tests\Belt\Core\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();

        Lyst::unguard();
        $list = Lyst::find(1);

        # show
        $list->update(['is_active' => true]);
        $response = $this->json('GET', '/lists/1');
        $response->assertStatus(200);

        # show (404)
        $list->update(['is_active' => false]);
        $response = $this->json('GET', '/lists/1');
        $response->assertStatus(404);

        # show (super, avoid 404)
        $this->actAsSuper();
        $response = $this->json('GET', '/lists/1');
        $response->assertStatus(200);
    }

}