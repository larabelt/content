<?php

use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Core\Services\Update\BaseUpdate;
use Belt\Content\Page;
use Belt\Content\Term;
use Belt\Spot\Event;
use Belt\Spot\Place;

/**
 * Class UpdateService
 * @package Belt\Core\Services
 */
class BeltUpdateContentSections extends BaseUpdate
{
    /**
     * @var array
     */
    public $argumentMap = [
        'types',
    ];

    protected $maps = [];

    public function up()
    {
        $this->info(sprintf('sections map'));

        $types = $this->argument('types', 'pages');

        foreach (explode(',', $types) as $type) {
            if (method_exists($this, $type)) {
                $this->$type();
            }
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

    public function getMap($sections = [], $map = [], $tree = [], $depth = 1)
    {
        $sections = $sections ?: [];

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

    public function pages()
    {
        $pages = Page::where('is_active', true)->get();
        $pages = Page::where('is_converted', false)->get();
        //$pages = Page::all();

        foreach ($pages as $page) {
            $map = $this->getMap($page->sections);
            $this->addMap($map, $page);
        }
    }

    public function places()
    {
        $places = Place::where('is_converted', false)->get();
        //$places = Place::all();

        foreach ($places as $place) {
            $map = $this->getMap($place->sections);
            $this->addMap($map, $place);
        }
    }

    public function events()
    {
        $events = Event::where('is_converted', false)->get();
        //$events = Event::all();

        foreach ($events as $event) {
            $map = $this->getMap($event->sections);
            $this->addMap($map, $event);
        }
    }

    public function terms()
    {
        $terms = Term::where('is_converted', false)->get();
        //$terms = Term::all();

        foreach ($terms as $term) {
            $map = $this->getMap($term->sections);
            $this->addMap($map, $term);
        }
    }

}