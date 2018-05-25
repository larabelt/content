<?php

namespace Belt\Spot\Http\Controllers\Api;

use Belt\Core\Http\Controllers\ApiController;
use Belt\Core\Http\Controllers\Behaviors\Positionable;
use Belt\Spot\Itinerary;
use Belt\Spot\ItineraryPlace;
use Belt\Spot\Place;
use Belt\Spot\Http\Requests;
use Illuminate\Http\Request;

class ItineraryPlacesController extends ApiController
{

    use Positionable;

    /**
     * @var Itinerary
     */
    public $itineraryPlace;

    /**
     * ItineraryPlacesController constructor.
     * @param ItineraryPlace $itineraryPlace
     * @param Place $place
     */
    public function __construct(ItineraryPlace $itineraryPlace, Place $place)
    {
        $this->itineraryPlace = $itineraryPlace;
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

    public function itineraryPlace($id)
    {
        $itineraryPlace = $this->itineraryPlace->with('place')->find($id);

        return $itineraryPlace ?: $this->abort(404);
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
        $request = Requests\PaginateItineraryPlaces::extend($request);

        $request->merge(['itinerary_id' => $itinerary->id]);

        $this->authorize(['view', 'create', 'update', 'delete'], $itinerary);

        $paginator = $this->paginator($this->itineraryPlace->with('place'), $request);

        return response()->json($paginator->toArray());
    }

    /**
     * Store a newly created resource in glue.
     *
     * @param  Requests\StoreItineraryPlace $request
     * @param Itinerary $itinerary
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreItineraryPlace $request, $itinerary)
    {
        $this->authorize('update', $itinerary);

        $place_id = $request->get('place_id');

        $itineraryPlace = $this->itineraryPlace->create([
            'itinerary_id' => $itinerary->id,
            'place_id' => $place_id,
        ]);

        $input = $request->all();

        $this->set($itineraryPlace, $input, [
            'heading',
            'body',
        ]);

        $itineraryPlace->save();

        $itineraryPlace = $this->itineraryPlace($itineraryPlace->id);

        return response()->json($itineraryPlace, 201);
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

        $itineraryPlace = $this->itineraryPlace($id);

        $input = $request->all();

        $this->set($itineraryPlace, $input, [
            'heading',
            'body',
        ]);

        $itineraryPlace->save();

        $this->reposition($request, $itineraryPlace);

        return response()->json($itineraryPlace);
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

        $itineraryPlace = $this->itineraryPlace($id);

        return response()->json($itineraryPlace);
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

        $itineraryPlace = $this->itineraryPlace($id);

        $itineraryPlace->delete();

        return response()->json(null, 204);
    }
}
