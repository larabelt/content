<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;;

/**
 * Class Listable
 * @package Belt\Content
 */
class Listable extends Model
{

    use SortableTrait;

    /**
     * @var string
     */
    protected $table = 'listable';

    /**
     * @var array
     */
    protected $fillable = ['list_id', 'place_id'];

    /**
     * @var array
     */
    protected static $sortableGroupField = ['list_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

}