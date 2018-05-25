<?php

namespace Belt\Spot\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Spot\Itinerary;
use Belt\Spot\Listable;
use Belt\Spot\Place;
use Belt\Spot\Http\Requests;
use Illuminate\Http\Request;

class ListablesController extends ApiController
{

    use Positionable;

    /**
     * @var Itinerary
     */
    public $listable;

    /**
     * ListablesController constructor.
     * @param Listable $listable
     * @param Place $place
     */
    public function __construct(Listable $listable, Place $place)
    {
        $this->listable = $listable;
        $this->place = $place;
    }

    /**
     * @param $itinerary
     * @param $id
     */
    public function contains($itinerary, $id)
    {
        if (!$itinerary->places->contains($id)) {
            $this->abort(404, 'itinerary does not have this place');
        }
    }

    public function listable($id)
    {
        $listable = $this->listable->with('place')->find($id);

        return $listable ?: $this->abort(404);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Itinerary $itinerary
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $itinerary)
    {
        $request = Requests\PaginateListables::extend($request);

        $request->merge(['itinerary_id' => $itinerary->id]);

        $this->authorize(['view', 'create', 'update', 'delete'], $itinerary);

        $paginator = $this->paginator($this->listable->with('place'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param  Requests\StoreListable $request
     * @param Itinerary $itinerary
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreListable $request, $itinerary)
    {
        $this->authorize('update', $itinerary);

        $place_id = $request->get('place_id');

        $listable = $this->listable->create([
            'itinerary_id' => $itinerary->id,
            'place_id' => $place_id,
        ]);

        $input = $request->all();

        $this->set($listable, $input, [
            'heading',
            'body',
        ]);

        $listable->save();

        $listable = $this->listable($listable->id);

        return response()->json($listable, 201);
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param Request $request
     * @param Itinerary $itinerary
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itinerary, $id)
    {
        $this->authorize('update', $itinerary);

        $this->contains($itinerary, $id);

        $listable = $this->listable($id);

        $input = $request->all();

        $this->set($listable, $input, [
            'heading',
            'body',
        ]);

        $listable->save();

        $this->reposition($request, $listable);

        return response()->json($listable);
    }

    /**
     * Display the specified resource.
     *
     * @param Itinerary $itinerary
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($itinerary, $id)
    {
        $this->authorize(['view', 'create', 'update', 'delete'], $itinerary);

        $this->contains($itinerary, $id);

        $listable = $this->listable($id);

        return response()->json($listable);
    }

    /**
     * Remove the specified resource from glue.
     *
     * @param Itinerary $itinerary
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($itinerary, $id)
    {

        $this->authorize('update', $itinerary);

        $this->contains($itinerary, $id);

        $listable = $this->listable($id);

        $listable->delete();

        return response()->json(null, 204);
    }
}
