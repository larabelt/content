<?php

namespace Belt\Content\Http\Controllers\Web;

use Auth;
use Belt\Content\Services\CompileService;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Page;

/**
 * Class PagesController
 * @package Belt\Content\Http\Controllers\Web
 */
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

        $this->middleware('web');
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

        $method = $this->env('APP_DEBUG') ? 'compile' : 'cache';

        /**
         * @todo below does not work on "handled" routes
         */
        if ($method == 'cache' && Auth::user()) {
            try {
                $this->authorize('update', $page);
                $method = 'compile';
            } catch (\Exception $e) {

            }
        }

        $compiled = $this->service->$method($page);

        return view('belt-content::pages.web.show', compact('page', 'compiled'));
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

        return view('belt-content::pages.web.show', compact('page', 'compiled'));
    }

}