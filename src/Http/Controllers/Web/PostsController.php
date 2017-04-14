<?php

namespace Belt\Content\Http\Controllers\Web;

use Auth;
use Belt\Content\Services\CompileService;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Post;

/**
 * Class PostsController
 * @package Belt\Content\Http\Controllers\Web
 */
class PostsController extends BaseController
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
     * @param  Post $post
     *
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {

        $method = $this->env('APP_DEBUG') ? 'compile' : 'cache';

        $force_compile = array_get($post->getTemplateConfig(), 'force_compile', false);
        if ($force_compile) {
            $method = 'compile';
        }

        /**
         * @todo below does not work on "handled" routes
         */
        if ($method == 'cache' && Auth::user()) {
            try {
                $this->authorize('update', $post);
                $method = 'compile';
            } catch (\Exception $e) {

            }
        }

        $compiled = $this->service->$method($post);

        return view('belt-content::posts.web.show', compact('post', 'compiled'));
    }

}