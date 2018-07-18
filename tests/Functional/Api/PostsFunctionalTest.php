<?php

use Belt\Content\Post;
use Belt\Core\Testing;

class PostsFunctionalTest extends Testing\BeltTestCase
{

    public function test()
    {
        $this->refreshDB();
        $this->actAsSuper();

        # index
        $response = $this->json('GET', '/api/v1/posts');
        $response->assertStatus(200);

        # store
        $response = $this->json('POST', '/api/v1/posts', [
            'name' => 'test',
        ]);
        $response->assertStatus(201);
        $postID = array_get($response->json(), 'id');

        # show
        $response = $this->json('GET', "/api/v1/posts/$postID");
        $response->assertStatus(200);

        # update
        $this->json('PUT', "/api/v1/posts/$postID", ['name' => 'updated']);
        $response = $this->json('GET', "/api/v1/posts/$postID");
        $response->assertJson(['name' => 'updated']);

        # copy
        Post::unguard();
        $old = Post::find($postID);
        $old->saveParam('foo', 'bar');
        $old->sections()->create(['sectionable_type' => 'sections']);
        $old->attachments()->attach(1);
        $old->categories()->attach(1);
        $old->tags()->attach(1);
        $old->handles()->create(['url' => '/copied-post']);
        $response = $this->json('POST', '/api/v1/posts', ['source' => $postID]);
        $response->assertStatus(201);
        $copiedPostID = array_get($response->json(), 'id');
        $response = $this->json('GET', "/api/v1/posts/$copiedPostID");
        $response->assertStatus(200);

        # delete
        $response = $this->json('DELETE', "/api/v1/posts/$postID");
        $response->assertStatus(204);
        $response = $this->json('GET', "/api/v1/posts/$postID");
        $response->assertStatus(404);
    }

}