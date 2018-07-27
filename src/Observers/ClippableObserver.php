<?php

namespace Belt\Content\Observers;

use Belt\Content\Behaviors\ClippableInterface;

class ClippableObserver
{
    /**
     * Listen to the ClippableInterface deleting $item.
     *
     * @clipp  ClippableInterface $item
     * @return void
     */
    public function deleting(ClippableInterface $item)
    {
        $item->attachments()->sync([]);
    }
}