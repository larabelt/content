<?php

namespace Ohio\Content\Http\Controllers\Api;

use Ohio\Core\Http\Controllers\ApiController;
use Ohio\Content\Page;
use Ohio\Content\Http\Requests;

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

        return response()->json($page);
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

        $page->delete();

        return response()->json(null, 204);
    }
}
