<?php

use Illuminate\Database\Seeder;

use Ohio\Content\Tag\Tag;

class OhioContentTagSeeds extends Seeder
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
