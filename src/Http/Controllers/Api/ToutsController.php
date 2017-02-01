<?php

namespace Ohio\Content\Http\Controllers\Api;

use Ohio\Core\Http\Controllers\ApiController;
use Ohio\Content\Tout;
use Ohio\Content\Http\Requests;

class ToutsController extends ApiController
{

    /**
     * @var Tout
     */
    public $tout;

    /**
     * ApiController constructor.
     * @param Tout $tout
     */
    public function __construct(Tout $tout)
    {
        $this->touts = $tout;
    }

    public function get($id)
    {
        return $this->touts->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function index(Requests\PaginateTouts $request)
    {
        $this->authorize('index', Tout::class);

        $paginator = $this->paginator($this->touts->query(), $request->reCapture());

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreTout $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreTout $request)
    {
        $this->authorize('create', Tout::class);

        $input = $request->all();

        $tout = $this->touts->create([
            'name' => $input['name'],
            'body' => $input['body'],
        ]);

        $this->set($tout, $input, [
            'template',
            'slug',
            'body',
        ]);

        $tout->save();

        return response()->json($tout);
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
        $tout = $this->get($id);

        $this->authorize('create', $tout);

        return response()->json($tout);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UpdateTout $request
     * @param  string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateTout $request, $id)
    {
        $tout = $this->get($id);

        $this->authorize('update', $tout);

        $input = $request->all();

        $this->set($tout, $input, [
            'template',
            'name',
            'slug',
            'body',
        ]);

        $tout->save();

        return response()->json($tout);
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
        $tout = $this->get($id);

        $this->authorize('delete', $tout);

        $tout->delete();

        return response()->json(null, 204);
    }
}
