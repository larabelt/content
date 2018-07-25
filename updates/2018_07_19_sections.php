<?php

use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Core\Services\Update\BaseUpdate;
use Belt\Content\Page;
use Belt\Content\Block;
use Belt\Content\Term;
use Belt\Content\Lyst;
use Belt\Content\ListItem;
use Illuminate\Support\Facades\DB;

/**
 * Class UpdateService
 * @package Belt\Core\Services
 */
class BeltUpdateContentSections extends BaseUpdate
{
    protected $map = [];

    public function up()
    {
        $this->info(sprintf('sections map'));

        $pages = Page::all();

        foreach ($pages as $page) {

            $map = [];

            foreach ($page->sections as $section) {
//                $map[] = [
//                    'subtype' => $section->subtype,
//                ];
                $map[] = $section->subtype;
            }

            $this->map['pages'][] = $map;

            //break;
        }

        dump($this->map);

    }


}