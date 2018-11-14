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
    Belt\Core\Behaviors\IncludesSubtypesInterface,
    Belt\Core\Behaviors\TranslatableInterface,
    Belt\Core\Behaviors\TypeInterface
{

    use SortableTrait;
    use Belt\Core\Behaviors\IncludesSubtypes;
    use Belt\Core\Behaviors\Translatable;
    use Belt\Core\Behaviors\TypeTrait;

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
    protected $appends = ['config', 'morph_class'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function listable()
    {
        return $this->morphTo();
    }

}