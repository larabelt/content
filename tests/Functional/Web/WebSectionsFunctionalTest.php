<?php

use Belt\Core\Testing;
use Belt\Content\Section;

class WebSectionsFunctionalTest extends Testing\BeltTestCase
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