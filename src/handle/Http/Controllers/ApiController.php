<?php

namespace Ohio\Content\Handle\Http\Controllers;

use Ohio\Core\Base\Http\Controllers\BaseApiController;

use Ohio\Content\Handle;
use Ohio\Content\Handle\Http\Requests;

use Illuminate\Http\Request;

class ApiController extends BaseApiController
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
    public function index(Request $request)
    {
        $request = $this->getPaginateRequest(Requests\PaginateRequest::class, $request->query());

        $paginator = $this->getPaginator($this->handle->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\CreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateRequest $request)
    {

        $handle = $this->handle->create($request->all());

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
     * @param  Requests\UpdateRequest $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateRequest $request, $id)
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
