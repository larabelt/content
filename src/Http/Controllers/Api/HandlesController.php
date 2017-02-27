<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Core\Helpers\MorphHelper;
use Belt\Content\Handle;
use Belt\Content\Http\Requests;

class HandlesController extends ApiController
{

    use Positionable;

    /**
     * @var Handle
     */
    public $handles;

    /**
     * @var MorphHelper
     */
    public $morphHelper;

    public function __construct(Handle $handle, MorphHelper $morphHelper)
    {
        $this->handles = $handle;
        $this->morphHelper = $morphHelper;
    }

    public function handle($id, $handleable = null)
    {
        $qb = $this->handles->query();

        if ($handleable) {
            $qb->handled($handleable->getMorphClass(), $handleable->id);
        }

        $handle = $qb->where('handles.id', $id)->first();

        return $handle ?: $this->abort(404);
    }

    public function handleable($handleable_type, $handleable_id)
    {
        $handleable = $this->morphHelper->morph($handleable_type, $handleable_id);

        return $handleable ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateHandles $request, $handleable_type, $handleable_id)
    {

        $request->reCapture();

        $owner = $this->handleable($handleable_type, $handleable_id);

        $this->authorize('view', $owner);

        $request->merge([
            'handleable_id' => $owner->id,
            'handleable_type' => $owner->getMorphClass()
        ]);

        $paginator = $this->paginator($this->handles->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param  Requests\StoreHandle $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreHandle $request, $handleable_type, $handleable_id)
    {
        $owner = $this->handleable($handleable_type, $handleable_id);

        $this->authorize('update', $owner);

        $handle = $this->handles->create($request->only([
            'handleable_id',
            'handleable_type',
            'url'
        ]));

        return response()->json($handle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($handleable_type, $handleable_id, $id)
    {
        $owner = $this->handleable($handleable_type, $handleable_id);

        $this->authorize('view', $owner);

        $handle = $this->handle($id, $owner);

        return response()->json($handle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateHandle $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateHandle $request, $handleable_type, $handleable_id, $id)
    {

        $owner = $this->handleable($handleable_type, $handleable_id);

        $this->authorize('update', $owner);

        $handle = $this->handle($id, $owner);

        $input = $request->all();

        $this->set($handle, $input, [
            'url',
        ]);

        $handle->save();

        return response()->json($handle);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($handleable_type, $handleable_id, $id)
    {
        $owner = $this->handleable($handleable_type, $handleable_id);

        $this->authorize('update', $owner);

        $handle = $this->handle($id, $owner);

        $handle->delete();

        return response()->json(null, 204);
    }
}
