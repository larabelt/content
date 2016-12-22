<?php

namespace Ohio\Content\Block\Http\Controllers\Api;

use Ohio\Core\Base\Http\Controllers\ApiController;
use Ohio\Content\Block\Block;
use Ohio\Content\Block\Http\Requests;

class BlocksController extends ApiController
{

    /**
     * @var Block
     */
    public $block;

    /**
     * ApiController constructor.
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->blocks = $block;
    }

    public function get($id)
    {
        return $this->blocks->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateBlocks $request)
    {

        $paginator = $this->paginator($this->blocks->query(), $request->reCapture());

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

        $input = $request->all();

        $block = $this->blocks->create([
            'name' => $input['name'],
            'body' => $input['body'],
        ]);

        $this->set($block, $input, [
            'template',
            'slug',
            'body',
        ]);

        $block->save();

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

        $input = $request->all();

        $this->set($block, $input, [
            'template',
            'name',
            'slug',
            'body',
        ]);

        $block->save();

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
