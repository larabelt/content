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
    protected $table = 'listables';

    /**
     * @var array
     */
    protected $fillable = ['list_id', 'listable_type', 'listable_id'];

    /**
     * @var array
     */
    protected static $sortableGroupField = ['list_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function listable()
    {
        return $this->morphTo('listable');
    }

}