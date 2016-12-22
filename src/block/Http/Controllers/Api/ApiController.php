<?php

namespace Ohio\Content\Block\Http\Controllers\Api;

use Ohio\Core\Base\Http\Controllers\BaseApiController;

use Ohio\Content\Block;
use Ohio\Content\Block\Http\Requests;

use Illuminate\Http\Request;

class BlocksController extends BaseApiController
{

    /**
     * @var Block\Block
     */
    public $block;

    /**
     * ApiController constructor.
     * @param Block\Block $block
     */
    public function __construct(Block\Block $block)
    {
        $this->block = $block;
    }

    public function get($id)
    {
        return $this->block->find($id) ?: $this->abort(404);
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

        $paginator = $this->paginator($this->block->query(), $request);

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

        $block = $this->block->create($request->all());

        return response()->json($block);
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
        $block = $this->get($id);

        return response()->json($block);
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
        $block = $this->get($id);

        $block->update($request->all());

        return response()->json($block);
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
        $block = $this->get($id);

        $block->delete();

        return response()->json(null, 204);
    }
}
