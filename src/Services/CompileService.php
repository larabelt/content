<?php

namespace Belt\Content\Services;

use Belt, Cache, View;
use Belt\Content\Behaviors\HasSectionsInterface;

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
        $this->clearCache($owner);

        $compiled = null;

        try {
            $compiled = View::make($owner->subtype_view, ['owner' => $owner])->render();
            
        } catch (\Exception $e) {

        }

        $this->putCache($owner, $compiled);

        return $compiled;
    }

    /**
     * @param $owner
     * @param bool $force
     * @return string
     */
    public function cache(HasSectionsInterface $owner, $force = false)
    {
        if ($force) {
            $this->clearCache($owner);
        }

        return $this->getCached($owner);
    }

    /**
     * @param HasSectionsInterface $owner
     */
    public function clearCache(HasSectionsInterface $owner)
    {
        Cache::forget($owner->getHasSectionsCacheKey());
    }

    /**
     * @param HasSectionsInterface $owner
     * @param $compiled
     */
    public function putCache(HasSectionsInterface $owner, $compiled)
    {
        Cache::put($owner->getHasSectionsCacheKey(), $compiled, 60);
    }

    /**
     * @param HasSectionsInterface $owner
     * @return string
     */
    public function getCached(HasSectionsInterface $owner)
    {
        return Cache::get($owner->getHasSectionsCacheKey()) ?: $this->compile($owner);
    }

}