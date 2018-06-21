<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Http\Controllers\Compiler;
use Belt\Content\Http\Requests;
use Belt\Content\Page;
use Illuminate\Http\Request;

/**
 * Class PagesController
 * @package Belt\Content\Http\Controllers\Api
 */
class PagesController extends ApiController
{

    use Compiler;

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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], Page::class);

        $request = Requests\PaginatePages::extend($request);

        $paginator = $this->paginator($this->pages->query(), $request);

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

        if ($source = $request->get('source')) {
            return response()->json($this->pages->copy($source), 201);
        }

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

        $page->save();

        $this->itemEvent('created', $page);

        return response()->json($page, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $page);

        $page->config = $page->getTemplateConfig();

        return response()->json($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdatePage $request
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdatePage $request, Page $page)
    {
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

        $this->compile($page, true);

        $this->itemEvent('updated', $page);

        return response()->json($page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->authorize('delete', $page);

        $this->itemEvent('deleted', $page);

        $page->delete();

        return response()->json(null, 204);
    }

}
