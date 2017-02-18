<?php
namespace Belt\Content\Services;

use Belt, Cache;
use Belt\Content\Page;

/**
 * Class CompileService
 * @package Belt\Content\Services
 */
class CompileService
{

    /**
     * CompileService constructor.
     */
    public function __construct()
    {
        $this->pages = new Page();
    }

    /**
     *
     */
    public function pages()
    {
        $qb = $this->pages->query();
        $qb->where('slug', 'sectioned');

        foreach ($qb->get() as $page) {
            $this->cache($page, true);
        }
    }

    /**
     * @param $page
     * @return string
     */
    public function compile($page)
    {
        return view($page->template_view, compact('page'))->render();
    }

    /**
     * @param $page
     * @param bool $force
     * @return string
     */
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