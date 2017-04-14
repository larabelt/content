<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Post;
use Belt\Content\Http\Requests;

/**
 * Class PostsController
 * @package Belt\Content\Http\Controllers\Api
 */
class PostsController extends ApiController
{

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
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginatePosts $request)
    {
        $this->authorize('index', Post::class);

        $paginator = $this->paginator($this->posts->query(), $request->reCapture());

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
        ]);

        $post->save();

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
        $this->authorize('view', $post);

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
        ]);

        $post->save();

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

        $post->delete();

        return response()->json(null, 204);
    }
}
