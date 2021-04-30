<?php

namespace Belt\Content\Observers;

use Belt\Content\Behaviors\HasSectionsInterface;
use Html2Text\Html2Text;
class HasSectionsObserver
{
    /**
     * Listen to the Handle saving $handle.
     *
     * @handle  Handle $handle
     * @return void
     */
    public function saving(HasSectionsInterface $item)
    {
        $item->searchable = $this->crawl($item);
    }
    
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

    /**
     * @param HasSectionsInterface $owner
     *
     * @return string
     */
    private function crawl(HasSectionsInterface $item)
    {

        $searchable = $this->getSearchable($item);

        foreach ($item->sections as $section) {
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
    private function __crawl($section, $searchable = '')
    {

        $searchable = $this->getSearchable($section, $searchable);

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
    private function getSearchable($item, $searchable = '')
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