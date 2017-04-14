<?php

use Belt\Content\Block;
use Belt\Content\Post;
use Belt\Content\Handle;
use Belt\Content\Section;
use Belt\Content\Tout;
use Belt\Clip\Attachment;
use Illuminate\Database\Seeder;

class BeltContentPostSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 25)->create();
    }

}