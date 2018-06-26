<?php

namespace Belt\Content\Services;

use Belt, Cache, View;
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
        $this->clearCache($owner);

        $compiled = null;

        try {
            $compiled = View::make($owner->template_view, ['owner' => $owner])->render();
            $owner->searchable = $this->crawl($owner);
            $owner->save();
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

    /**
     * @param HasSectionsInterface $owner
     *
     * @return string
     */
    public function crawl(HasSectionsInterface $owner)
    {

        $searchable = $this->getSearchable($owner);

        foreach ($owner->sections as $section) {
            $searchable = $this->__crawl($section, $searchable);
        }

        $searchable = preg_replace('/\s+/', ' ', $searchable);

        try {
            $text = Html2Text::convert($searchable);
            $searchable = $text;
        } catch (\Exception $e) {

        }

        return $searchable;
    }

    /**
     * @param $section
     * @param $searchable
     *
     * @return string
     */
    public function __crawl($section, $searchable = '')
    {

        $searchable = $this->getSearchable($section, $searchable);

//        if ($sectionable = $section->sectionable) {
//            if ($sectionable instanceof SectionableInterface) {
//                $searchable = $this->getSearchable($sectionable, $searchable);
//            }
//        }

        foreach ($section->children as $child) {
            $searchable = $this->__crawl($child, $searchable);
        }

        return $searchable;
    }

    /**
     * @param $item
     * @param string $searchable
     * @return string
     */
    public function getSearchable($item, $searchable = '')
    {
        $new = [];
        $new[] = $item->getAttribute('name');
        $new[] = $item->getAttribute('heading');
        $new[] = $item->getAttribute('before');
        $new[] = $item->getAttribute('body');
        $new[] = $item->getAttribute('after');
        $new[] = $item->getAttribute('meta_title');
        $new[] = $item->getAttribute('meta_keywords');
        $new[] = $item->getAttribute('meta_description');

        $new = preg_replace('/\s+/', ' ', implode(' ', $new));

        $searchable .= strip_tags($new);

        return $searchable;
    }

}