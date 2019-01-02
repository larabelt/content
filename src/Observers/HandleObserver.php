<?php

namespace Belt\Content\Observers;

use DB, Translate;
use Belt\Content\Handle;

class HandleObserver
{
    /**
     * Listen to the Handle saving $handle.
     *
     * @handle  Handle $handle
     * @return void
     */
    public function saving(Handle $handle)
    {
        if ($handle->is_default) {
            $handle->is_active = true;
        }

        if ($handle->subtype == 'alias') {
            $handle->target = null;
        }

    }

    /**
     * Listen to the Handle saving $handle.
     *
     * @handle  Handle $handle
     * @return void
     */
    public function saved(Handle $handle)
    {
        if ($handle->is_default && $handle->subtype == 'alias') {
            DB::table('handles')
                ->where('handleable_type', $handle->handleable_type)
                ->where('handleable_id', $handle->handleable_id)
                ->where('id', '!=', $handle->id)
                ->update(['is_default' => false]);
        }
    }
}