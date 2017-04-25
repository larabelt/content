<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Post;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PostTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\Post::sections
     */
    public function test()
    {
        $post = factory(Post::class)->make();

        $this->assertInstanceOf(MorphMany::class, $post->sections());
    }

}