<?php namespace Tests\Belt\Content\Feature\Web;

use Belt\Core\Tests;
use Belt\Content\Section;

class WebSectionsFunctionalTest extends Tests\BeltTestCase
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