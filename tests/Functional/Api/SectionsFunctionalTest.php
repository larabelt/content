<?php

use Belt\Core\Testing;

class SectionsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/pages/1/sections');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/pages/1/sections', [
            'sectionable_id' => 1,
            'sectionable_type' => 'blocks',
            'template' => 'blocks',
            'heading' => 'test',
        ]);
        $response->assertStatus(201);
        $sectionID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/pages/1/sections/$sectionID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/pages/1/sections/$sectionID", [
            'heading' => 'updated'
        ]);
        $response = $this->json('GET', "/api/v1/pages/1/sections/$sectionID");
        $response->assertJson(['heading' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/pages/1/sections/$sectionID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/pages/1/sections/$sectionID");
        $response->assertStatus(404);
    }

}