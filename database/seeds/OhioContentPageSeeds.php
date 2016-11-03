<?php

use Illuminate\Database\Seeder;

use Ohio\Content\Page;

class OhioContentPageSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page\Page::class, 5)->create();
    }
}
