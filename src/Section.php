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
    protected $fillable = ['owner_id', 'owner_type', 'sectionable_type', 'parent_id'];

    /**
     * @var array
     */
    protected $appends = ['name'];

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        $type = $this->sectionable_type == 'sections' ? 'boxes' : $this->sectionable_type;

        return ucfirst(str_singular($type));
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

    /**
     * Return sections associated with owner
     *
     * @param $query
     * @param $owner_type
     * @param $owner_id
     * @return mixed
     */
    public function scopeOwned($query, $owner_type, $owner_id)
    {
        $query->select(['sections.*']);
        $query->where('sections.owner_type', $owner_type);
        $query->where('sections.owner_id', $owner_id);

        return $query;
    }

}