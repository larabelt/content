<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Morphable;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Content\Lyst;
use Belt\Content\ListItem;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

class ListItemsController extends ApiController
{

    use Morphable;
    use Positionable;

    /**
     * @var ListItem
     */
    public $listable;

    /**
     * ListItemsController constructor.
     * @param ListItem $listable
     */
    public function __construct(ListItem $listable)
    {
        $this->listable = $listable;
    }

    /**
     * @param $list
     * @param $id
     */
    public function contains($list, $id)
    {
        if (!$list->listables->contains($id)) {
            $this->abort(404, 'list does not have this listable');
        }
    }

    public function listable($id)
    {
        $listable = $this->listable->with('listable')->find($id);

        return $listable ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param List $list
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $list)
    {
        $request = Requests\PaginateListItems::extend($request);

        $request->merge(['list_id' => $list->id]);

        $this->authorize(['view', 'create', 'update', 'delete'], $list);

        $paginator = $this->paginator($this->listable->with('listable'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param  Requests\StoreListItem $request
     * @param List $list
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreListItem $request, $list)
    {
        $this->authorize('update', $list);

        $listable_type = $request->get('listable_type');

        $listable_id = $request->get('listable_id');

        $listable = $this->morphable($listable_type, $listable_id);

        $listItem = $this->listable->create([
            'list_id' => $list->id,
            'listable_type' => $listable_type,
            'listable_id' => $listable_id,
        ]);

        return response()->json($listItem, 201);
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param Request $request
     * @param List $list
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $list, $id)
    {
        $this->authorize('update', $list);

        $this->contains($list, $id);

        $listable = $this->listable($id);

        $input = $request->all();

        $this->set($listable, $input, [
            'heading',
            'body',
        ]);

        $listable->save();

        $this->reposition($request, $listable);

        return response()->json($listable);
    }

    /**
     * Display the specified resource.
     *
     * @param List $list
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($list, $id)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $list);

        $this->contains($list, $id);

        $listable = $this->listable($id);

        return response()->json($listable);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param List $list
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($list, $id)
    {

        $this->authorize('update', $list);

        $this->contains($list, $id);

        $listable = $this->listable($id);

        $listable->delete();

        return response()->json(null, 204);
    }
}
