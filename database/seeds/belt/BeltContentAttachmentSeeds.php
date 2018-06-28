<?php

use Illuminate\Database\Seeder;

use Belt\Content\Attachment;

class BeltContentAttachmentSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Attachment::class, 25)->create();
    }
}
