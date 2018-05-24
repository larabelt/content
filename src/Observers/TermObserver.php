<?php

namespace Belt\Content\Observers;

use Belt;
use Belt\Content\Term;
use Illuminate\Support\Facades\DB;

class TermObserver
{

    private $dispatch = false;

    /**
     * Listen to the Term deleting event.
     *
     * @param  Term $term
     * @return void
     */
    public function deleting(Term $term)
    {
        $term->attachments()->detach();

        foreach ($term->sections as $section) {
            $section->delete();
        }

        DB::table('termables')->where('term_id', $term->id)->delete();
    }

    /**
     * Listen to the Term saving event.
     *
     * @param  Term $term
     * @return void
     */
    public function saving(Term $term)
    {
        $dirty = $term->getDirty();
        if (isset($dirty['name']) || isset($dirty['slug'])) {
            $this->readyDispatch();
        }
    }

    /**
     * Listen to the Term saving event.
     *
     * @param  Term $term
     * @return void
     */
    public function saved(Term $term)
    {
        if ($this->dispatch) {
            $this->dispatch($term);
        }
    }

    /**
     * Get observer ready to dispatch job
     */
    public function readyDispatch()
    {
        $this->dispatch = true;
    }

    /**
     * Dispath job
     *
     * @param $term
     */
    public function dispatch($term)
    {
        $this->dispatch = false;
        dispatch(new Belt\Content\Jobs\UpdateTermData($term));
    }

}