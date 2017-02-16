<?php
namespace Belt\Content\Services;

use Belt, Cache;
use Belt\Content\Page;

class CompileService
{

    //sectionable: menu, breadcrumbs

    public function __construct()
    {
        $this->pages = new Page();
    }

    public function pages()
    {
        $qb = $this->pages->query();
        $qb->where('slug', 'sectioned');

        foreach ($qb->get() as $page) {
            $this->cache($page, true);
        }
    }

    public function compile($page)
    {
        return view($page->template_view, compact('page'))->render();
    }

    public function cache($page, $force = false)
    {
        $compiled = Cache::get('pages:' . $page->id) ?: $this->compile($page);

        if (!$compiled || $force) {
            $compiled = $this->compile($page);
        }

        if ($force) {
            Cache::put('pages:' . $page->id, $compiled, 3600);
        } else {
            Cache::add('pages:' . $page->id, $compiled, 3600);
        }

        return $compiled;
    }

}