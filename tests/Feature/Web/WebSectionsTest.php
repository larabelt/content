<?php namespace Tests\Belt\Content\Feature\Web;

use Tests\Belt\Core;
use Belt\Content\Section;

class WebSectionsTest extends \Tests\Belt\Core\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        $section = Section::first();

        # index
        $response = $this->json('GET', "/sections/$section->id/preview");
        $response->assertStatus(200);
    }

}