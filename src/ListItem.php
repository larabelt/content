<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

;

/**
 * Class ListItem
 * @package Belt\Content
 */
class ListItem extends Model implements
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\IncludesSubtypesInterface
{

    use SortableTrait;
    use Belt\Core\Behaviors\IncludesSubtypes;

    /**
     * @var string
     */
    protected $morphClass = 'list_items';

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
    protected $with = ['params'];

    /**
     * @var array
     */
    protected static $sortableGroupField = ['list_id'];

    /**
     * @var array
     */
    protected $appends = ['config'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function listable()
    {
        return $this->morphTo();
    }

}