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

    public function __construct(Handle $handle)
    {
        $this->handles = $handle;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $handleable_type, $handleable_id)
    {
        $request = Requests\PaginateHandles::extend($request);

        $owner = $this->morphable($handleable_type, $handleable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $request->merge([
            'handleable_id' => $owner->id,
            'handleable_type' => $owner->getMorphClass()
        ]);

        $qb = $this->handles->query();
        $qb->orderBy('is_default', 'desc');
        $qb->orderBy('url');

        $paginator = $this->paginator($qb, $request);

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
        $owner = $this->morphable($handleable_type, $handleable_id);

        $this->authorize('update', $owner);

        $input = $request->all();

        $handle = $this->handles->create(['url' => $input['url']]);

        $this->set($handle, $input, [
            'handleable_id',
            'handleable_type',
            'config_name',
            'is_active',
            'is_default',
            'url',
            'target',
        ]);

        $handle->save();

        $handle->syncDefault();

        return response()->json($handle, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Handle $handle
     *
     * @return \Illuminate\Http\Response
     */
    public function show($handleable_type, $handleable_id, $handle)
    {
        $owner = $this->morphable($handleable_type, $handleable_id);

        $this->authorize(['view', 'create', 'update', 'delete'], $owner);

        $this->morphableContains($owner, 'handles', $handle);

        return response()->json($handle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateHandle $request
     * @param  Handle $handle
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateHandle $request, $handleable_type, $handleable_id, $handle)
    {

        $owner = $this->morphable($handleable_type, $handleable_id);

        $this->authorize('update', $owner);

        $this->morphableContains($owner, 'handles', $handle);

        $input = $request->all();

        $this->set($handle, $input, [
            'config_name',
            'is_default',
            'url',
            'target',
        ]);

        $handle->save();

        $handle->syncDefault();

        return response()->json($handle);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param  Handle $handle
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($handleable_type, $handleable_id, $handle)
    {
        $owner = $this->morphable($handleable_type, $handleable_id);

        $this->authorize('update', $owner);

        $this->morphableContains($owner, 'handles', $handle);

        $handle->delete();

        return response()->json(null, 204);
    }
}
