<?php
namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Section
 * @package Belt\Content
 */
class Section extends Model implements
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Content\Behaviors\SectionableInterface
{

    use NodeTrait;
    use Belt\Core\Behaviors\Paramable;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\IncludesTemplate;
    use Belt\Content\Behaviors\Sectionable;

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

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return ucfirst(str_singular($this->sectionable_type));

//        $name = sprintf('%s:%s', str_singular($this->sectionable_type), $this->template);
//
//        $sectionable = $this->sectionable;
//        if ($sectionable && $sectionable instanceof Belt\Content\Behaviors\SectionableInterface) {
//            $name = $sectionable->getSectionName();
//        }
//
//        return $name . $this->id;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();

        $data['children'] = $this->children->toArray();

        return $data;
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