<?php

namespace Belt\Content\Http\Controllers\Api;

use Route;
use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Handle;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

class HandlesController extends ApiController
{

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
        $this->handle = $handle;
    }

    public function get($id)
    {
        return $this->handle->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateHandles $request)
    {
        $this->authorize('index', Handle::class);

        $request->reCapture();

        $paginator = $this->paginator($this->handle->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreHandle $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreHandle $request)
    {
        $this->authorize('create', Handle::class);

        $handle = $this->handle->create($request->only([
            'handleable_id', 'handleable_type', 'url'
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
    public function show($id)
    {
        $handle = $this->get($id);

        $this->authorize('view', $handle);

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
    public function update(Requests\UpdateHandle $request, $id)
    {
        $handle = $this->get($id);

        $this->authorize('update', $handle);

        $handle->update($request->all());

        return response()->json($handle);
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
        $handle = $this->get($id);

        $this->authorize('delete', $handle);

        $handle->delete();

        return response()->json(null, 204);
    }
}
