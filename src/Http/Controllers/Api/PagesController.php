<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Page;
use Belt\Content\Http\Requests;

/**
 * Class PagesController
 * @package Belt\Content\Http\Controllers\Api
 */
class PagesController extends ApiController
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
        $this->pages = $page;
    }

    /**
     * @param $id
     */
    public function get($id)
    {
        return $this->pages->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginatePages $request)
    {
        $this->authorize('index', Page::class);

        $paginator = $this->paginator($this->pages->query(), $request->reCapture());

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StorePage $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePage $request)
    {
        $this->authorize('create', Page::class);

        $input = $request->all();

        $page = $this->pages->create(['name' => $input['name']]);

        $this->set($page, $input, [
            'is_active',
            'template',
            'slug',
            'body',
            'meta_title',
            'meta_keywords',
            'meta_description',
        ]);

        return response()->json($page, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = $this->get($id);

        $this->authorize('view', $page);

        return response()->json($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdatePage $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePage $request, $id)
    {
        $page = $this->get($id);

        $this->authorize('update', $page);

        $input = $request->all();

        $this->set($page, $input, [
            'is_active',
            'template',
            'name',
            'slug',
            'body',
            'meta_title',
            'meta_keywords',
            'meta_description',
        ]);

        $page->save();

        return response()->json($page);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = $this->get($id);

        $this->authorize('delete', $page);

        $page->delete();

        return response()->json(null, 204);
    }
}
