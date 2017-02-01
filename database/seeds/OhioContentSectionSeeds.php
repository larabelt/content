<?php

use Illuminate\Database\Seeder;

use Ohio\Content\Section;
use Ohio\Content\Handle;

class OhioContentSectionSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Section::class, 25)->create();
    }
}
