<?php

namespace Belt\Content\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Content\Tout;
use Belt\Content\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class ToutsController
 * @package Belt\Content\Http\Controllers\Api
 */
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

    /**
     * @param $id
     */
    public function get($id)
    {
        return $this->touts->with('attachment')->find($id) ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', Tout::class);

        $request = Requests\PaginateTouts::extend($request);

        $paginator = $this->paginator($this->touts->with('attachment'), $request);

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
            'attachment_id',
            'template',
            'slug',
            'body',
            'heading',
            'btn_text',
            'btn_url',
        ]);

        $tout->save();

        $this->itemEvent('created', $tout);

        return response()->json($tout, 201);
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

        $this->authorize('view', $tout);

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
            'attachment_id',
            'template',
            'name',
            'slug',
            'body',
            'heading',
            'btn_text',
            'btn_url',
        ]);

        $tout->save();

        $this->itemEvent('updated', $tout);

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

        $this->itemEvent('deleted', $tout);

        $tout->delete();

        return response()->json(null, 204);
    }
}
