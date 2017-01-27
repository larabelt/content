<?php

namespace Ohio\Content\Handle\Http\Controllers\Api;

use Route;
use Ohio\Core\Base\Http\Controllers\ApiController;

use Ohio\Content\Handle;
use Ohio\Content\Handle\Http\Requests;

use Illuminate\Http\Request;

class HandlesController extends ApiController
{

    /**
     * @var Handle\Handle
     */
    public $handle;

    /**
     * ApiController constructor.
     * @param Handle\Handle $handle
     */
    public function __construct(Handle\Handle $handle)
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

        $handle = $this->handle->create($request->only([
            'handleable_id', 'handleable_type', 'url'
        ]));

        return response()->json($handle);
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

        $handle->delete();

        return response()->json(null, 204);
    }
}
