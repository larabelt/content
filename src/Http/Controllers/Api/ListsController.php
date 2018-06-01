<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Lyst;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class ListsController
 * @package Belt\Content\Http\Controllers\Api
 */
class ListsController extends ApiController
{

    /**
     * @var Lyst
     */
    public $lists;

    /**
     * ApiController constructor.
     * @param Lyst $list
     */
    public function __construct(Lyst $list)
    {
        $this->lists = $list;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request = Requests\PaginateLists::extend($request);

        $this->authorize(['view', 'create', 'update', 'delete'], Lyst::class);

        $paginator = $this->paginator($this->lists->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreList $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreList $request)
    {
        $this->authorize('create', Lyst::class);

        if ($source = $request->get('source')) {
            return response()->json($this->lists->copy($source), 201);
        }

        $input = $request->all();

        $list = $this->lists->create([
            'name' => $input['name'],
        ]);

        $this->set($list, $input, [
            'is_active',
            'is_searchable',
            'status',
            'template',
            'slug',
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        $list->save();

        $this->itemEvent('created', $list);

        return response()->json($list, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Lyst $list
     *
     * @return \Illuminate\Http\Response
     */
    public function show($list)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $list);

        $list->items;
        foreach ($list->items as $item) {
            $item->listable;
        }

        return response()->json($list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateList $request
     * @param  Lyst $list
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateList $request, $list)
    {
        $this->authorize('update', $list);

        $input = $request->all();

        $this->set($list, $input, [
            'is_active',
            'is_searchable',
            'status',
            'template',
            'name',
            'slug',
            'meta_title',
            'meta_description',
            'meta_keywords',
        ]);

        $list->save();

        $this->itemEvent('updated', $list);

        return response()->json($list);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Lyst $list
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($list)
    {
        $this->authorize('delete', $list);

        $this->itemEvent('deleted', $list);

        $list->delete();

        return response()->json(null, 204);
    }
}
