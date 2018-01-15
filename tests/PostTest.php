<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Post;
use Illuminate\Database\Eloquent\Builder;

class PostTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Post::toSearchableArray
     * @covers \Belt\Content\Post::getIsPublicAttribute
     * @covers \Belt\Content\Post::scopeIsPublic
     */
    public function test()
    {


        # toSearchableArray
        $post = factory(Post::class)->make();
        $this->assertNotEmpty($post->toSearchableArray());

        # is_public
        $post = factory(Post::class)->make(['is_active' => true, 'post_at' => date('Y-m-d H:i:s', strtotime('-1 day'))]);
        $this->assertTrue($post->is_public);
        $post = factory(Post::class)->make(['is_active' => true, 'post_at' => strtotime('+1 day')]);
        $this->assertFalse($post->is_public);

        # scopeIsPublic
        $now = date('Y-m-d H:i:s');
        $post = factory(Post::class)->make();
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->with('posts.is_active', true)->andReturnSelf();
        $query->shouldReceive('where')->with('posts.post_at', '<', $now)->andReturnSelf();
        $post->scopeIsPublic($query, $now);


    }

}