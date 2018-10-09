<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Block;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class BlocksController
 * @package Belt\Content\Http\Controllers\Api
 */
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

    /**
     * @param $id
     */
    public function get($id)
    {
        return $this->blocks->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], Block::class);

        $request = Requests\PaginateBlocks::extend($request);

        $paginator = $this->paginator($this->blocks->query(), $request);

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
        $this->authorize('create', Block::class);

        $input = $request->all();

        $block = $this->blocks->create([
            'name' => $input['name'],
            'body' => '',
        ]);

        $this->set($block, $input, [
            'subtype',
            'slug',
            'heading',
            'body',
        ]);

        $block->save();

        $this->itemEvent('created', $block);

        return response()->json($block, 201);
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

        $this->authorize(['view', 'create', 'update', 'delete'], $block);

        $block->append(['config']);

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

        $this->authorize('update', $block);

        $input = $request->all();

        $this->set($block, $input, [
            'subtype',
            'name',
            'slug',
            'heading',
            'body',
        ]);

        $block->save();

        $this->itemEvent('updated', $block);

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

        $this->authorize('delete', $block);

        $this->itemEvent('deleted', $block);

        $block->delete();

        return response()->json(null, 204);
    }
}
