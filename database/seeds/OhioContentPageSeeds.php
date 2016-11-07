<?php

use Illuminate\Database\Seeder;

use Ohio\Content\Page\Page;
use Ohio\Content\Handle\Handle;

class OhioContentPageSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page::class, 120)
            ->create()
            ->each(function ($page) {
                $page->handles()->save(factory(Handle::class)->make());
            });
        ;
    }
}
