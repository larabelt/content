<?php

namespace Ohio\Content\Block\Http\Controllers\Api;

use Ohio\Core\Base\Http\Controllers\ApiController;

use Ohio\Content\Block;
use Ohio\Content\Block\Http\Requests;

use Illuminate\Http\Request;

class BlocksController extends ApiController
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
    public function index(Requests\PaginateBlocks $request)
    {

        $request->reCapture();

        $paginator = $this->paginator($this->block->query(), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreBlock $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreBlock $request)
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
     * @param  Requests\UpdateBlock $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateBlock $request, $id)
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
