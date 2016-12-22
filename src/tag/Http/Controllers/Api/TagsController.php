<?php

namespace Ohio\Content\Tag\Http\Controllers\Api;

use Ohio\Core\Base\Http\Controllers\ApiController;
use Ohio\Content\Tag\Tag;
use Ohio\Content\Tag\Http\Requests;

class TagsController extends ApiController
{

    /**
     * @var Tag
     */
    public $tags;

    /**
     * ApiController constructor.
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tags = $tag;
    }

    public function get($id)
    {
        return $this->tags->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateTags $request)
    {
        $paginator = $this->paginator($this->tags->query(), $request->reCapture());

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreTag $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreTag $request)
    {

        $input = $request->all();

        $tag = $this->tags->create([
            'name' => $input['name'],
        ]);

        $this->set($tag, $input, [
            'slug',
            'body',
        ]);

        $tag->save();

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
     * @param  Requests\UpdateTag $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateTag $request, $id)
    {
        $tag = $this->get($id);

        $input = $request->all();

        $this->set($tag, $input, [
            'name',
            'slug',
            'body',
        ]);

        $tag->save();

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
