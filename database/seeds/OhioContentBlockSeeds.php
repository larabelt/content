<?php

use Illuminate\Database\Seeder;

use Ohio\Content\Block;
use Ohio\Content\Handle;

class OhioContentBlockSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Block::class, 25)->create();
    }
}