<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;;

/**
 * Class ListItem
 * @package Belt\Content
 */
class ListItem extends Model
{

    use SortableTrait;

    /**
     * @var string
     */
    protected $table = 'list_items';

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