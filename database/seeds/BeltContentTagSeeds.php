<?php

use Illuminate\Database\Seeder;

use Belt\Content\Tag;

class BeltContentTagSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 25)->create();
    }
}
