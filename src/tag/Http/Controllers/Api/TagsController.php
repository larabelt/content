<?php

namespace Ohio\Content\Tag\Http\Controllers;

use Ohio\Core\Base\Http\Controllers\BaseApiController;

use Ohio\Content\Tag;
use Ohio\Content\Tag\Http\Requests;

use Illuminate\Http\Request;

class ApiController extends BaseApiController
{

    /**
     * @var Tag\Tag
     */
    public $tag;

    /**
     * ApiController constructor.
     * @param Tag\Tag $tag
     */
    public function __construct(Tag\Tag $tag)
    {
        $this->tag = $tag;
    }

    public function get($id)
    {
        return $this->tag->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateRequest $request)
    {
        $request->reCapture();

        $paginator = $this->paginator($this->tag->query(), $request);

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

        $tag = $this->tag->create($request->all());

        return response()->json($tag);
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
        $tag = $this->get($id);

        return response()->json($tag);
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
        $tag = $this->get($id);

        $tag->update($request->all());

        return response()->json($tag);
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
        $tag = $this->get($id);

        $tag->delete();

        return response()->json(null, 204);
    }
}
