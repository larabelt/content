<?php

use Illuminate\Database\Seeder;

use Belt\Spot\List;
use Belt\Spot\Listable;

class BeltSpotListSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(List::class, 5)->create()
            ->each(function ($list) {
                for ($i = 1; $i <= 5; $i++) {

                    $faker = Faker\Factory::create();

                    Listable::firstOrCreate([
                       'list_id' => $list->id,
                       'place_id' => $i,
                       'heading' => $faker->words(3, true),
                       'body' => $faker->words(20, true),
                    ]);
                }
            });
    }
}
