<?php

use Belt\Core\Testing;
use Belt\Content\Post;

class WebPostsFunctionalTest extends Testing\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();
        $this->actAsSuper();

        Post::unguard();
        $post = Post::find(1);
        $post->update(['is_active' => true]);

        # show
        $response = $this->json('GET', '/posts/1');
        $response->assertStatus(200);

        $post->update(['is_active' => false]);

        # show (404)
        $response = $this->json('GET', '/posts/1');
        $response->assertStatus(404);

    }

}