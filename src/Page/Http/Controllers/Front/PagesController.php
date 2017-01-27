<?php

namespace Ohio\Content\Page\Http\Controllers\Front;

use Ohio\Core\Base\Http\Controllers\BaseController;

use Ohio\Content\Page;

class PagesController extends BaseController
{

    /**
     * @var Page\Page
     */
    public $page;

    /**
     * ApiController constructor.
     * @param Page\Page $page
     */
    public function __construct(Page\Page $page)
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
    public function show($id)
    {
        $page = $this->get($id);

        return view('ohio-content::page.front.show', compact('page'));
    }

}