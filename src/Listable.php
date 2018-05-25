<?php

namespace Belt\Spot;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;;

/**
 * Class ItineraryPlace
 * @package Belt\Spot
 */
class ItineraryPlace extends Model
{

    use SortableTrait;

    /**
     * @var string
     */
    protected $table = 'itinerary_place';

    /**
     * @var array
     */
    protected $fillable = ['itinerary_id', 'place_id'];

    /**
     * @var array
     */
    protected static $sortableGroupField = ['itinerary_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}