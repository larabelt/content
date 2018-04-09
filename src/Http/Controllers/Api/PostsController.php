<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Post;
use Belt\Content\Http\Controllers\Compiler;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class PostsController
 * @package Belt\Content\Http\Controllers\Api
 */
class PostsController extends ApiController
{
    use Compiler;

    /**
     * @var Post
     */
    public $post;

    /**
     * ApiController constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->posts = $post;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = Requests\PaginatePosts::extend($request);

        $paginator = $this->paginator($this->posts->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StorePost $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePost $request)
    {
        $this->authorize('create', Post::class);

        $input = $request->all();

        $post = $this->posts->create(['name' => $input['name']]);

        $this->set($post, $input, [
            'is_active',
            'template',
            'slug',
            'body',
            'meta_title',
            'meta_keywords',
            'meta_description',
            'post_at',
            'source_url',
            'source_name',
        ]);

        $post->save();

        $this->itemEvent('created', $post);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->compiled = $this->compile($post, true);
        $post->sections;

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdatePost $request
     * @param  Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePost $request, Post $post)
    {
        $this->authorize('update', $post);

        $input = $request->all();

        $this->set($post, $input, [
            'is_active',
            'template',
            'name',
            'slug',
            'body',
            'meta_title',
            'meta_keywords',
            'meta_description',
            'post_at',
            'source_url',
            'source_name',
        ]);

        $post->save();

        $this->compile($post, true);

        $this->itemEvent('updated', $post);

        return response()->json($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->itemEvent('deleted', $post);

        $post->delete();

        return response()->json(null, 204);
    }
}
