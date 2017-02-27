<?php

namespace Belt\Content\Http\Controllers\Web;

use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Section;

/**
 * Class SectionsController
 * @package Belt\Content\Http\Controllers\Web
 */
class SectionsController extends BaseController
{

    /**
     * Display the specified resource.
     *
     * @param  Section $section
     *
     * @return \Illuminate\View\View
     */
    public function preview(Section $section)
    {

        $this->authorize('update', $section);

        $preview = view($section->template_view, ['section' => $section])->render();

        return view('belt-content::sections.web.preview', ['preview' => $preview]);
    }

}