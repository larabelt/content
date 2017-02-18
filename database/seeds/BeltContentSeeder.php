<?php

use Illuminate\Database\Seeder;

class BeltContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BeltContentPageSeeds::class);
        $this->call(BeltContentBlockSeeds::class);
        $this->call(BeltContentToutSeeds::class);
    }
}
