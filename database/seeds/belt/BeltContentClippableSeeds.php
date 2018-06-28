<?php

use Illuminate\Database\Seeder;

use Belt\Content\Attachment;
use Belt\Content\Album;

class BeltContentClippableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attachments = Attachment::all();
        $albums = Album::take(25)->get();
        foreach ($albums as $album) {
            $limit = rand(3, 5);
            for ($i = 1; $i <= $limit; $i++) {
                $attachment = $attachments->random();
                $album->attachAttachment($attachment);
            }
        }
    }
}
