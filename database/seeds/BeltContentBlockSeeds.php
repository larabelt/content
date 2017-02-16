<?php

use Illuminate\Database\Seeder;

use Belt\Content\Block;
use Belt\Content\Handle;

class BeltContentBlockSeeds extends Seeder
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
