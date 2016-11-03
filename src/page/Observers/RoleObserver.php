<?php
namespace Ohio\Content\Page\Observers;

use Ohio\Content\Page\Page;

class PageObserver
{

    /**
     * Listen to the User creating event.
     *
     * @param  Page  $page
     * @return void
     */
    public function creating(Page $page)
    {
        $page->slug = $page->slug ?: str_slug($page->name);
    }

}