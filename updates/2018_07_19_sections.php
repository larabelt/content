<?php

use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Core\Services\Update\BaseUpdate;
use Belt\Content\Page;

/**
 * Class UpdateService
 * @package Belt\Core\Services
 */
class BeltUpdateContentSections extends BaseUpdate
{
    protected $maps = [];

    public function up()
    {
        $this->info(sprintf('sections map'));

        //$pages = Page::where('id', 71)->get();
        $pages = Page::all();

        foreach ($pages as $page) {
            //$this->map['pages'][$page->id] = $this->sections($page->sections);
            $map = $this->sections($page->sections);
            $map['count'] = 1;
            $this->addMap($map);
        }

        dump($this->maps);
    }

    public function addMap($new_map)
    {
        foreach ($this->maps as $n => $map) {
            if ($map == $new_map) {
                return $this->maps[$n]['count']++;
            }
        }

        $this->maps[] = $new_map;
    }

    public function sections($sections, $map = [], $tree = [], $depth = 1)
    {
        foreach ($sections as $n => $section) {

            $tree[$depth] = isset($tree[$depth]) ? $tree[$depth] + 1 : 1;

            $key = implode('.', $tree);

            $map[$key] = $section->subtype;

            if ($section->children->count()) {
                $map = $this->sections($section->children, $map, $tree, $depth + 1);
            }
        }

        return $map;
    }

}