<?php namespace Tests\Belt\Content\Feature\Web;

use Belt\Core\Tests;
use Belt\Content\Post;

class WebPostsFunctionalTest extends Tests\BeltTestCase
{

    public function testAsSuper()
    {
        $this->refreshDB();

        Post::unguard();
        $post = Post::find(1);

        # show
        $post->update(['is_active' => true]);
        $response = $this->json('GET', '/posts/1');
        $response->assertStatus(200);

        # show (404)
        $post->update(['is_active' => false]);
        $response = $this->json('GET', '/posts/1');
        $response->assertStatus(404);

        # show (super, avoid 404)
        $this->actAsSuper();
        $response = $this->json('GET', '/posts/1');
        $response->assertStatus(200);

    }

}