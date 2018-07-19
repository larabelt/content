<?php

namespace Belt\Content;

use Belt, View;
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
    Belt\Core\Behaviors\IncludesSubtypesInterface,
    Belt\Content\Behaviors\SectionableInterface
{

    use NodeTrait {
        children as nodeChildren;
    }
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Core\Behaviors\IncludesSubtypes;
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
    protected $fillable = ['template', 'owner_id', 'owner_type', 'sectionable_type', 'parent_id'];

    /**
     * @var array
     */
    protected $appends = ['name', 'morph_class', 'template_subgroup', 'preview'];

    /**
     * @return mixed|string
     * @throws \Exception
     */
    public function getNameAttribute()
    {
        $names = explode('.', $this->subtype);

        $name = isset($names[0]) ? title_case(str_singular($names[0])) : '???';
        if (isset($names[1]) && $names[1] != 'default') {
            $name .= sprintf(' [%s]', title_case($names[1]));
        }

        $name = $this->getSubtypeConfig('name') ?: $name;

        if ($name instanceof \Closure) {
            $name = $name->call($this);
        }

        return $name;
    }

    /**
     * @return mixed
     */
    public function getTemplateSubgroupAttribute()
    {
        return array_first(explode('.', $this->subtype));
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

    /**
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo('owner');
    }

    /**
     * The Associated owning model
     *
     * @deprecated
     * @return MorphTo|Model
     */
    public function sectionable()
    {
        return $this->morphTo();
    }

//    /**
//     * Get a relationship value from a method.
//     *
//     * @deprecated
//     * @param  string $method
//     * @return mixed
//     *
//     * @throws \LogicException
//     */
//    protected function getRelationshipFromMethod($method)
//    {
//        if ($method == 'sectionable' && !$this->sectionable_id) {
//            return null;
//        }
//
//        return parent::getRelationshipFromMethod($method);
//    }

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
     * @return \Closure|mixed|string
     * @throws \Exception
     */
    public function getPreviewAttribute()
    {
        $default = 'belt-content::sections.previews.default';

        $preview = $this->getSubtypeConfig('preview', $default);

        if (is_string($preview) && View::exists($preview)) {
            $preview = function () use ($preview) {
                return view($preview, ['section' => $this]);
            };
        }

        if ($preview instanceof \Closure) {
            $preview = $preview->call($this);
        }

        if ($preview instanceof \Illuminate\View\View) {
            $preview = $preview->render();
        }

        return $preview;
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
        $clone->setIsCopy(true);
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