<?php
/**
 * Created by PhpStorm.
 * User: rlasota
 * Date: 4/6/17
 * Time: 5:26 PM
 */

namespace Belt\Content\Observers;


use Belt\Content\Section;

class SectionObserver
{
    /**
     * Listen to the Section deleting event.
     *
     * @param  Section  $section
     * @return void
     */
    public function deleting(Section $section)
    {
        foreach($section->params as $param) {
            $param->delete();
        }
    }
}