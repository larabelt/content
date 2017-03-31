<?php

namespace Belt\Content\Services;

use Belt, Cache;
use Belt\Content\Page;
use Belt\Content\Behaviors\HasSectionsInterface;
use Html2Text\Html2Text;

/**
 * Class CompileService
 * @package Belt\Content\Services
 */
class CompileService
{

    /**
     * @param $owner
     * @return string
     */
    public function compile(HasSectionsInterface $owner)
    {
        $compiled = view($owner->template_view, ['owner' => $owner])->render();

        $this->searchable($owner, $compiled);

        return $compiled;
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

    /**
     * @param HasSectionsInterface $owner
     * @param $compiled
     */
    public function searchable(HasSectionsInterface $owner, $compiled)
    {
        $searchable = strip_tags($compiled);

        try {
            $searchable = Html2Text::convert($searchable);
        } catch (\Exception $e) {

        }

        $owner->searchable = $searchable;
        $owner->save();
    }

}