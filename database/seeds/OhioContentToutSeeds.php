<?php

use Illuminate\Database\Seeder;

use Ohio\Content\Tout;
use Ohio\Content\Handle;

class OhioContentToutSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tout::class, 25)->create();
    }
}
