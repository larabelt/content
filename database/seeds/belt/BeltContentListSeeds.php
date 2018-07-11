<?php

use Illuminate\Database\Seeder;

use Belt\Content\Lyst;
use Belt\Content\ListItem;

class BeltContentListSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Lyst::class, 5)->create()
            ->each(function ($list) {
                for ($i = 1; $i <= 5; $i++) {
                    $item = ListItem::firstOrCreate([
                        'template' => 'page',
                        'list_id' => $list->id,
                    ]);
                    $item->saveParam('pages', $i);
                }
            });
    }
}
