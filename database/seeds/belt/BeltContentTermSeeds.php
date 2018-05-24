<?php

use Belt\Content\Term;
use Illuminate\Database\Seeder;

class BeltContentTermSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Term::class, 10)
            ->create()
            ->each(function ($c1) {
                factory(Term::class, random_int(3, 5))
                    ->create(['parent_id' => $c1->id])
                    ->each(function ($c2) {
                        $count = random_int(0, 3);
                        if ($count) {
                            factory(Term::class, random_int(3, 5))
                                ->create(['parent_id' => $c2->id]);
                        }
                    });
            });

    }

}
