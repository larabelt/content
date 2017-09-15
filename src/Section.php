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
    Belt\Core\Behaviors\NestedSetInterface,
    Belt\Core\Behaviors\TypeInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Content\Behaviors\SectionableInterface
{

    use NodeTrait {
        children as nodeChildren;
    }
    use Belt\Core\Behaviors\TypeTrait;
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
    protected $appends = ['name', 'morph_class'];

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

        //$name = strlen($name) < 25 ? $name : sprintf('%s...', substr($name, 0, 22));

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

//    /**
//     * @return MorphTo
//     */
//    public function owner()
//    {
//        return $this->morphTo('owner');
//    }

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
     * Get a relationship value from a method.
     *
     * @param  string $method
     * @return mixed
     *
     * @throws \LogicException
     */
    protected function getRelationshipFromMethod($method)
    {
        if ($method == 'sectionable' && !$this->sectionable_id) {
            return null;
        }

        return parent::getRelationshipFromMethod($method);
    }

    /**
     * @return mixed
     */
    public function getTemplateGroup()
    {
        return $this->sectionable_type ?: 'sections';
    }

    /**
     * Child sections
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->nodeChildren()->orderBy('_lft');
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

    /**
     * @param $section
     * @param array $options
     * @return Model
     */
    public static function copy($section, $options = [])
    {
        $section = $section instanceof Section ? $section : self::find($section)->first();

        $section->load('params');

        $clone = $section->replicate(['_lft', '_rgt']);
        $clone->owner_id = array_get($options, 'owner_id');
        $clone->parent_id = array_get($options, 'parent_id');
        $clone->save();

        foreach ($section->params as $param) {
            //Belt\Core\Param::copy($param, ['paramable_id' => $clone->id]);
            $clone->saveParam($param->key, $param->value);
        }

        foreach ($section->children as $child) {
            static::copy($child, [
                'owner_id' => array_get($options, 'owner_id'),
                'parent_id' => $clone->id,
            ]);
        }

        return $clone;
    }

}