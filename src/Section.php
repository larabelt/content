<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

class Section extends Model implements
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface
{

    use NodeTrait;
    use Belt\Core\Behaviors\Paramable;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\IncludesTemplate;

    protected $morphClass = 'sections';

    protected $table = 'sections';

    protected $fillable = ['name', 'body'];

    protected static $sortableGroupField = 'page_id';

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function sectionable()
    {
        return $this->morphTo();
    }

    public function getTemplateGroup()
    {
        return $this->sectionable_type;
    }

}