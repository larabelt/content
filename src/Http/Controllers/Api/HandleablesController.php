<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Core\Http\Controllers\Behaviors\Morphable;
use Belt\Content\Handle;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

class HandleablesController extends ApiController
{

    use Morphable, Positionable;

    /**
     * @var Handle
     */
    public $handles;

    /**
     * HandleablesController constructor.
     * @param Handle $handle
     */
    public function __construct(Handle $handle)
    {
        $this->handles = $handle;
    }

    /**
     * @param $handleable_type
     * @param $handleable_id
     * @param Handle|null $handle
     * @return mixed
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     */
    private function handleable($handleable_type, $handleable_id, Handle $handle = null)
    {
        $handleable = $this->morph($handleable_type, $handleable_id);

        if ($handle && !$handleable->handles->contains($handle->id)) {
            $this->abort(404, 'handle does not belong to owner');
        }

        return $handleable;
    }

    /**
     * Display a listing of the resource
     *
     * @param Request $request
     * @param $handleable_type
     * @param $handleable_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, $handleable_type, $handleable_id)
    {
        $request = Requests\PaginateHandles::extend($request);

        $handleable = $this->handleable($handleable_type, $handleable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $handleable);

        $request->merge([
            'handleable_id' => $handleable->id,
            'handleable_type' => $handleable->getMorphClass()
        ]);

        $qb = $this->handles->query();
        $qb->orderBy('is_default', 'desc');
        $qb->orderBy('url');

        $paginator = $this->paginator($qb, $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource
     *
     * @param Requests\StoreHandle $request
     * @param $handleable_type
     * @param $handleable_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Requests\StoreHandle $request, $handleable_type, $handleable_id)
    {
        $handleable = $this->handleable($handleable_type, $handleable_id);

        $this->authorize('update', $handleable);

        $input = $request->all();

        $handle = $this->handles->create(['url' => $input['url']]);

        $this->set($handle, $input, [
            'handleable_id',
            'handleable_type',
            'locale',
            'subtype',
            'is_active',
            'is_default',
            'url',
            'target',
        ]);

        $handle->save();

        return response()->json($handle, 201);
    }

    /**
     * Display the specified resource
     *
     * @param $handleable_type
     * @param $handleable_id
     * @param $handle
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($handleable_type, $handleable_id, $handle)
    {
        $handleable = $this->handleable($handleable_type, $handleable_id, $handle);

        $this->authorize(['view', 'create', 'update', 'delete'], $handleable);

        return response()->json($handle);
    }

    /**
     * Update the specified resource
     *
     * @param Requests\UpdateHandle $request
     * @param $handleable_type
     * @param $handleable_id
     * @param $handle
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Requests\UpdateHandle $request, $handleable_type, $handleable_id, $handle)
    {

        $handleable = $this->handleable($handleable_type, $handleable_id, $handle);

        $this->authorize('update', $handleable);

        $input = $request->all();

        $this->set($handle, $input, [
            'locale',
            'subtype',
            'is_active',
            'is_default',
            'url',
            'target',
        ]);

        $handle->save();

        return response()->json($handle);
    }

    /**
     * Remove the specified resource
     *
     * @param $handleable_type
     * @param $handleable_id
     * @param $handle
     * @return \Illuminate\Http\JsonResponse
     * @throws \Belt\Core\Http\Exceptions\ApiException
     * @throws \Belt\Core\Http\Exceptions\ApiNotFoundHttpException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($handleable_type, $handleable_id, $handle)
    {
        $handleable = $this->handleable($handleable_type, $handleable_id, $handle);

        $this->authorize('update', $handleable);

        $handle->delete();

        return response()->json(null, 204);
    }
}
