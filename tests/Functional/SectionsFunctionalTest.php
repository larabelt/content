<?php

use Belt\Core\Testing;

class SectionsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/sections');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/sections', [
            'page_id' => 1,
            'parent_id' => 0,
            'sectionable_id' => 0,
            'sectionable_type' => 'sections',
            'template' => 'default',
            'body' => 'test',
        ]);
        $response->assertStatus(201);
        $sectionID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/sections/$sectionID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/sections/$sectionID", ['body' => 'updated']);
        $response = $this->json('GET', "/api/v1/sections/$sectionID");
        $response->assertJson(['body' => 'updated']);

        # delete
        $response = $this->json('DELETE', "/api/v1/sections/$sectionID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/sections/$sectionID");
        $response->assertStatus(404);
    }

}