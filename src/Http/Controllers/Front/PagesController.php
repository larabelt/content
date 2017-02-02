<?php

namespace Ohio\Content\Http\Controllers\Front;

use Illuminate\Http\Request;
use Ohio\Core\Http\Controllers\BaseController;
use Ohio\Content\Page;

class PagesController extends BaseController
{

    /**
     * @var Page
     */
    public $page;

    /**
     * ApiController constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function get($id)
    {
        $key = is_numeric($id) ? 'id' : 'slug';

        return $this->page->where($key, $id)->first() ?: abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $page = $this->get($id);

        $template = $request->get('preview') ? 'preview' : 'show';

        return view("ohio-content::page.front.$template", compact('page'));
    }

}