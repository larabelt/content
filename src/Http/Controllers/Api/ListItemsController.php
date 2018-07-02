<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Morphable;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
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
    public $listItems;

    /**
     * ListItemsController constructor.
     * @param ListItem $listItem
     */
    public function __construct(ListItem $listItem)
    {
        $this->listItems = $listItem;
    }

    /**
     * @param $list
     * @param $id
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     */
    public function contains($list, $id)
    {
        if (!$list->items->contains($id)) {
            $this->abort(404, 'list does not have this item');
        }
    }

    /**
     * @param $id
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     */
    public function listItem($id)
    {
        $listItem = $this->listItems->with('listable')->find($id);

        return $listItem ?: $this->abort(404);
    }

    /**
     * @param Request $request
     * @param $list
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $list)
    {
        $request = Requests\PaginateListItems::extend($request);

        $request->merge(['list_id' => $list->id]);

        $this->authorize(['view', 'create', 'update', 'delete'], $list);

        $paginator = $this->paginator($this->listItems->with('listable'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * @param Requests\StoreListItem $request
     * @param $list
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Requests\StoreListItem $request, $list)
    {
        $this->authorize('update', $list);

//        $listable_type = $request->get('listable_type');
//        $listable_id = $request->get('listable_id');
//        $this->morphable($listable_type, $listable_id);

        $input = $request->all();

        $listItem = $this->listItems->create([
            'list_id' => $list->id,
        ]);

        $this->set($listItem, $input, [
            'template',
        ]);

        $listItem->save();

        return response()->json($listItem, 201);
    }

    /**
     * @param Request $request
     * @param $list
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Requests\UpdateListItem $request, $list, $id)
    {
        $this->authorize('update', $list);

        $this->contains($list, $id);

        $listItem = $this->listItem($id);

        $this->reposition($request, $listItem);

        $input = $request->all();

        $this->set($listItem, $input, [
            'template',
        ]);

        $listItem->save();

        return response()->json($listItem);
    }

    /**
     * @param $list
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($list, $id)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $list);

        $this->contains($list, $id);

        $listItem = $this->listItem($id);

        return response()->json($listItem);
    }

    /**
     * @param $list
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($list, $id)
    {

        $this->authorize('update', $list);

        $this->contains($list, $id);

        $listItem = $this->listItem($id);

        $listItem->delete();

        return response()->json(null, 204);
    }
}
