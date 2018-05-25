<?php

use Illuminate\Database\Seeder;

use Belt\Spot\Itinerary;
use Belt\Spot\ItineraryPlace;

class BeltSpotItinerarySeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Itinerary::class, 5)->create()
            ->each(function ($itinerary) {
                for ($i = 1; $i <= 5; $i++) {

                    $faker = Faker\Factory::create();

                    ItineraryPlace::firstOrCreate([
                       'itinerary_id' => $itinerary->id,
                       'place_id' => $i,
                       'heading' => $faker->words(3, true),
                       'body' => $faker->words(20, true),
                    ]);
                }
            });
    }
}
