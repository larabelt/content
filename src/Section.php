<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Section
 * @package Belt\Content
 */
class Section extends Model implements
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface
{

    use NodeTrait;
    use Belt\Core\Behaviors\Paramable;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\IncludesTemplate;

    /**
     * @var string
     */
    protected $morphClass = 'sections';

    /**
     * @var string
     */
    protected $table = 'sections';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $appends = ['name'];

    /**
     * @var string
     */
    protected static $sortableGroupField = 'page_id';

    public function getNameAttribute()
    {
        $name = ucfirst(Str::singular($this->sectionable_type));

        if ($this->sectionable) {
            $name .= ': ' . $this->sectionable->slug;
        } else {
            $name .= ': ' . $this->template;
        }

        return $name;
    }

    public function getChildrenAttribute()
    {
        return $this->children();
    }

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function sectionable()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function getTemplateGroup()
    {
        return $this->sectionable_type;
    }

}