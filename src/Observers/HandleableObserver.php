<?php

namespace Belt\Content\Observers;

use Belt\Content\Behaviors\HandleableInterface;

class HandleableObserver
{
    /**
     * Listen to the HandleableInterface deleting $item.
     *
     * @handle  HandleableInterface $item
     * @return void
     */
    public function deleting(HandleableInterface $item)
    {
        $item->handles()->delete();
    }
}