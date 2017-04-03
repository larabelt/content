<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Str;

/**
 * Class Section
 * @package Belt\Content
 */
class Section extends Model implements
    Belt\Core\Behaviors\NodeInterface,
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
        $type = $name = $this->sectionable_type;

        $sectionable = $this->sectionable;

        $name = $type == 'sections' ? 'html container' : $name;
        $name = $type == 'custom' ? sprintf('%s', $this->template) : $name;
        $name = $type == 'menus' ? sprintf('Menu: %s', $this->template) : $name;
        $name = $sectionable ? $sectionable->getSectionName() : $name;

        $name = title_case(str_singular($name));

        $name = strlen($name) < 25 ? $name : sprintf('%s...', substr($name, 0, 22));

        return ucfirst(str_singular($name));
    }

    /**
     * @return string
     */
    public function getSectionName()
    {
        return 'box';
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        $data['children'] = $this->children()->orderBy('_lft')->get()->toArray();

        return $data;
    }

    public function owner()
    {
        return $this->morphTo();
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
        return $this->sectionable_type ?: 'sections';
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
//
//    public function getConfigAttribute()
//    {
//        $defaults = [
//            'width' => 12,
//        ];
//
//        $config = $this->getTemplateConfig();
//
//        return array_merge($defaults, $config);
//    }

}