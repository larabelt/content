<?php

namespace Belt\Content\Observers;

use Belt\Content\Behaviors\HasSectionsInterface;

class HasSectionsObserver
{
    /**
     * Listen to the HasSectionsInterface deleting $item.
     *
     * @param  HasSectionsInterface $item
     * @return void
     */
    public function deleting(HasSectionsInterface $item)
    {
        $item->sections()->delete();
    }
}