<?php

namespace Ohio\Content\Http\Controllers\Web;

use Auth;
use Ohio\Content\Services\CompileService;
use Ohio\Core\Http\Controllers\BaseController;
use Ohio\Content\Page;
use Illuminate\Http\Request;

class PagesController extends BaseController
{

    /**
     * @var Page
     */
    public $page;

    /**
     * @var CompileService
     */
    public $service;

    /**
     * ApiController constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;

        $this->service = new CompileService();
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

        $compiled = $this->service->cache($page);

        return view("ohio-content::pages.web.show", compact('page', 'compiled'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function preview($id)
    {
        $page = $this->get($id);

        $this->authorize('update', $page);

        $compiled = $this->service->compile($page);

        return view("ohio-content::pages.web.show", compact('page', 'compiled'));
    }

}