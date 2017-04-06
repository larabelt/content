<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @package Belt\Content
 */
class Page extends Model implements
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Content\Behaviors\HandleableInterface,
    Belt\Content\Behaviors\HasSectionsInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Glue\Behaviors\CategorizableInterface,
    Belt\Glue\Behaviors\TaggableInterface,
    Belt\Clip\Behaviors\ClippableInterface
{
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\HasSections;
    use Belt\Content\Behaviors\IncludesTemplate;
    use Belt\Glue\Behaviors\Categorizable;
    use Belt\Glue\Behaviors\Taggable;
    use SoftDeletes;
    use Belt\Clip\Behaviors\Clippable;

    /**
     * @var string
     */
    protected $morphClass = 'pages';

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var array
     */
    protected $appends = ['image'];

}