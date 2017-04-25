<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Morphable;
use Belt\Content\Handle;
use Belt\Content\Http\Requests;

/**
 * Class HandlesController
 * @package Belt\Content\Http\Controllers\Api
 */
class HandlesController extends ApiController
{
    use Morphable;

    /**
     * @var Handle
     */
    public $handle;

    /**
     * ApiController constructor.
     * @param Handle $handle
     */
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
    public function index(Requests\PaginateHandles $request)
    {
        $paginator = $this->paginator($this->handles->with('handleable'), $request->reCapture());

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\StoreHandle $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreHandle $request)
    {
        $this->authorize('create', Handle::class);

        $this->morphRequest($request, 'handleable');

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
    public function show(Handle $handle)
    {
        $this->authorize('view', $handle);

        /**
         * called to append to toArray()
         */
        $handle->handleable;

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
    public function update(Requests\UpdateHandle $request, Handle $handle)
    {
        $this->authorize('update', $handle);

        $input = $request->all();

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

        return response()->json($handle);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Handle $handle
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handle $handle)
    {
        $this->authorize('delete', $handle);

        $handle->delete();

        return response()->json(null, 204);
    }
}
