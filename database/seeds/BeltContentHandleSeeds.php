<?php

use Illuminate\Database\Seeder;

use Belt\Content\Handle;

class BeltContentHandleSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Handle::class, 10)->create();
        factory(Handle::class, 10)->create(['is_active' => 0]);
    }
}
