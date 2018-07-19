<?php

namespace Belt\Content\Http\Controllers\Web;

use Belt\Content\Http\Controllers\Compiler;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Content\Post;

/**
 * Class PostsController
 * @package Belt\Content\Http\Controllers\Web
 */
class PostsController extends BaseController
{

    use Compiler;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
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
        if (!$post->is_active) {
            try {
                $this->authorize('update', $post);
            } catch (\Exception $e) {
                abort(404);
            }
        }

        $compiled = $this->compile($post);

        $owner = $post;

        $view = $post->getSubtypeConfig('extends', 'belt-content::posts.web.show');

        return view($view, compact('owner', 'post', 'compiled'));
    }

}