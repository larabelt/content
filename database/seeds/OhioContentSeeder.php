<?php

use Illuminate\Database\Seeder;

class OhioContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OhioContentPageSeeds::class);
        $this->call(OhioContentBlockSeeds::class);
        $this->call(OhioContentCategorySeeds::class);
        $this->call(OhioContentSectionSeeds::class);
        $this->call(OhioContentTagSeeds::class);
        $this->call(OhioContentToutSeeds::class);
    }
}
