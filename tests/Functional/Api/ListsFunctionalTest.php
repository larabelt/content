<?php

use Belt\Core\Testing;

use Belt\Content\Lyst;

class ApiListsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/lists');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/lists', [
            'name' => 'test',
        ]);

        $response->assertStatus(201);
        $listID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/lists/$listID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/lists/$listID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/lists/$listID");

        $response->assertJson(['name' => 'updated']);

        # copy
        Lyst::unguard();
        $old = Lyst::find($listID);
        $old->sections()->create(['sectionable_type' => 'sections']);
        $old->attachments()->attach(1);
        $old->items()->create([
            'template' => 'pages',
        ]);
        $old->terms()->attach(1);
        $old->handles()->create(['url' => '/copied-list']);
        $response = $this->json('POST', '/api/v1/lists', ['source' => $listID]);
        $response->assertStatus(201);
        $copiedListID = array_get($response->json(), 'id');
        $response = $this->json('GET', "/api/v1/lists/$copiedListID");
        $response->assertStatus(200);

        # delete
        $response = $this->json('DELETE', "/api/v1/lists/$listID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/lists/$listID");
        $response->assertStatus(404);
    }

}