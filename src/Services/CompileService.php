<?php

namespace Belt\Content\Services;

use Belt, Cache;
use Belt\Content\Page;
use Belt\Content\Behaviors\HasSectionsInterface;

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

        foreach ($qb->get() as $owner) {
            $this->cache($owner, true);
        }
    }

    /**
     * @param $owner
     * @return string
     */
    public function compile(HasSectionsInterface $owner)
    {
        return view($owner->template_view, ['owner' => $owner])->render();
    }

    /**
     * @param $owner
     * @param bool $force
     * @return string
     */
    public function cache(HasSectionsInterface $owner, $force = false)
    {

        $key = sprintf('compiled-%s-%s', $owner->getMorphClass(), $owner->id);

        $compiled = Cache::get($key) ?: $this->compile($owner);

        if (!$compiled || $force) {
            $compiled = $this->compile($owner);
        }

        if ($force) {
            Cache::put($key, $compiled, 3600);
        } else {
            Cache::add($key, $compiled, 3600);
        }

        return $compiled;
    }

}