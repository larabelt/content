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
     * @var CompileService
     */
    public $service;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->service = new CompileService();
    }

    /**
     * Display the specified resource.
     *
     * @param  Page $page
     *
     * @return \Illuminate\View\View
     */
    public function show(Page $page)
    {

        $compiled = $this->service->cache($page);

        return view('pages.web.show', compact('page', 'compiled'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Page $page
     *
     * @return \Illuminate\View\View
     */
    public function preview(Page $page)
    {
        $this->authorize('update', $page);

        $compiled = $this->service->compile($page);

        return view('pages.web.show', compact('page', 'compiled'));
    }

}