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
        $this->call(BeltContentBlockSeeds::class);
        $this->call(BeltContentFavoriteSeeds::class);
        $this->call(BeltContentHandleSeeds::class);
        $this->call(BeltContentPageSeeds::class);
        $this->call(BeltContentPostSeeds::class);
        $this->call(BeltContentTermSeeds::class);
        $this->call(BeltContentPermissbleSeeds::class);
    }
}
