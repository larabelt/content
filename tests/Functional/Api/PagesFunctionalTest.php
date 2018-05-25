<?php

use Belt\Core\Testing;
use Belt\Content\Page;

class PagesFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/pages');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/pages', [
            'name' => 'test',
        ]);
        $response->assertStatus(201);
        $pageID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/pages/$pageID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/pages/$pageID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/pages/$pageID");
        $response->assertJson(['name' => 'updated']);

        # copy
        Page::unguard();
        $old = Page::find($pageID);
        $old->sections()->create(['sectionable_type' => 'sections']);
        $old->attachments()->attach(1);
        $old->terms()->attach(1);
        $old->handles()->create(['url' => '/copied-page']);
        $response = $this->json('POST', '/api/v1/pages', ['source' => $pageID]);
        $response->assertStatus(201);
        $copiedPageID = array_get($response->json(), 'id');
        $response = $this->json('GET', "/api/v1/pages/$copiedPageID");
        $response->assertStatus(200);

        # delete
        $response = $this->json('DELETE', "/api/v1/pages/$pageID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/pages/$pageID");
        $response->assertStatus(404);
    }

}