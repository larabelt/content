<?php

use Belt\Core\Testing;
use Belt\Content\Section;

class SectionsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # store
        $response = $this->json('POST', '/api/v1/pages/1/sections', [
            'sectionable_id' => 1,
            'sectionable_type' => 'blocks',
            'template' => 'blocks',
            'heading' => 'test',
        ]);
        $response->assertStatus(201);
        $sectionID = array_get($response->json(), 'id');

        # index
        $response = $this->json('GET', '/api/v1/pages/1/sections');
        $response->assertStatus(200);

        # show
        $response = $this->json('GET', "/api/v1/pages/1/sections/$sectionID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/pages/1/sections/$sectionID", [
            'heading' => 'updated'
        ]);
        $response = $this->json('GET', "/api/v1/pages/1/sections/$sectionID");
        $response->assertJson(['heading' => 'updated']);

        # copy
        Section::unguard();
        $old = Section::find($sectionID);
        $old->saveParam('foo', 'bar');
        $old->children()->create(['owner_id' => 1, 'owner_type' => 'pages', 'sectionable_type' => 'sections']);
        $new = Section::copy($old, ['owner_id' => 2]);
        $response = $this->json('GET', "/api/v1/pages/2/sections/$new->id");
        $response->assertStatus(200);

        # delete
        $response = $this->json('DELETE', "/api/v1/pages/1/sections/$sectionID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/pages/1/sections/$sectionID");
        $response->assertStatus(404);
    }

}