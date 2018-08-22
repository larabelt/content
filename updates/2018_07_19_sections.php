<?php

use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Core\Services\Update\BaseUpdate;
use Belt\Content\Page;
use Belt\Spot\Place;

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

        $pages = Page::where('is_active', true)->get();
        $pages = Page::where('is_converted', false)->get();
        //$pages = Page::all();

        foreach ($pages as $page) {
            $map = $this->getMap($page->sections);
            $this->addMap($map, $page);
        }

        $places = Place::where('is_converted', false)->get();
        //$places = Place::all();

        foreach ($places as $place) {
            $map = $this->getMap($place->sections);
            $this->addMap($map, $place);
        }

        dump($this->maps);
    }

    public function addMap($new_map, $object)
    {
        foreach ($this->maps as $n => $map) {

            $tmp_map = $map;
            unset($tmp_map['count']);
            unset($tmp_map['ids']);

            if ($new_map == $tmp_map) {
                $this->maps[$n]['ids'][$object->getMorphClass()][] = sprintf('%s - %s', $object->id, $object->subtype);
                return $this->maps[$n]['count']++;
            }
        }

        $new_map['count'] = 1;
        $new_map['ids'][$object->getMorphClass()][] = sprintf('%s - %s', $object->id, $object->subtype);

        $this->maps[] = $new_map;
    }

    public function getMap($sections, $map = [], $tree = [], $depth = 1)
    {
        foreach ($sections as $n => $section) {

            $tree[$depth] = isset($tree[$depth]) ? $tree[$depth] + 1 : 1;

            $key = implode('.', $tree);

            $map[$key] = $section->subtype;

            if ($section->children->count()) {
                $map = $this->getMap($section->children, $map, $tree, $depth + 1);
            }
        }

        return $map;
    }

}