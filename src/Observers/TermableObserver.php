<?php

namespace Belt\Content\Observers;

use Belt\Content\Behaviors\TermableInterface;

class TermableObserver
{
    /**
     * Listen to the TermableInterface deleting $item.
     *
     * @term  TermableInterface $item
     * @return void
     */
    public function deleting(TermableInterface $item)
    {
        $item->terms()->sync([]);
    }
}