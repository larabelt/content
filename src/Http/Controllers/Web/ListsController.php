<?php

namespace Belt\Spot\Http\Controllers\Web;

use Belt\Content\Http\Controllers\Compiler;
use Belt\Core\Http\Controllers\BaseController;
use Belt\Spot\Itinerary;

/**
 * Class ItinerariesController
 * @package Belt\Spot\Http\Controllers\Web
 */
class ItinerariesController extends BaseController
{

    use Compiler;

    /**
     * ApiController constructor.
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Display the specified resource.
     *
     * @param  Itinerary $itinerary
     *
     * @return \Illuminate\View\View
     */
    public function show(Itinerary $itinerary)
    {
        if (!$itinerary->is_active) {
            try {
                $this->authorize('update', $itinerary);
            } catch (\Exception $e) {
                abort(404);
            }
        }

        $compiled = $this->compile($itinerary);

        $owner = $itinerary;

        $view = $itinerary->getTemplateConfig('extends', 'belt-spot::itineraries.web.show');

        return view($view, compact('owner', 'itinerary', 'compiled'));
    }

}