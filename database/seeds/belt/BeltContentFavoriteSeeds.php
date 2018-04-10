<?php

use Belt\Content\Favorite;
use Illuminate\Database\Seeder;

class BeltContentFavoriteSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::unguard();
        for ($u = 1; $u < 6; $u++) {
            for ($p = 1; $p < 6; $p++) {
                Favorite::create([
                    'user_id' => $u,
                    'favoriteable_type' => 'places',
                    'favoriteable_id' => $p,
                ]);
                Favorite::create([
                    'guid' => "guid-$u",
                    'favoriteable_type' => 'places',
                    'favoriteable_id' => $p,
                ]);
            }
        }
    }

}