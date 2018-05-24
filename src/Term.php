<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Term
 * @package Belt\Content
 */
class Term extends Model implements
    Belt\Core\Behaviors\IsNestedInterface,
    Belt\Core\Behaviors\IsSearchableInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Core\Behaviors\TypeInterface,
    Belt\Clip\Behaviors\ClippableInterface,
    Belt\Content\Behaviors\HasSectionsInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface
{

    use Belt\Core\Behaviors\IsNested;
    use Belt\Core\Behaviors\IsSearchable;
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Clip\Behaviors\Clippable;
    use Belt\Content\Behaviors\HasSections;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\IncludesTemplate;

    /**
     * @var string
     */
    protected $morphClass = 'terms';

    /**
     * @var string
     */
    protected $table = 'terms';

    /**
     * @var array
     */
    protected $fillable = ['name', 'body'];

    /**
     * @var array
     */
    protected $appends = ['full_name', 'default_url', 'url', 'hierarchy', 'image', 'morph_class'];

    /**
     * @var array
     */
    protected $casts = [
        'names' => 'array',
        'slugs' => 'array',
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->getNestedName();
    }

    /**
     * Return terms associated with termable
     *
     * @param $query
     * @param $termable_type
     * @param $termable_id
     * @return mixed
     */
    public function scopeTerm($query, $termable_type, $termable_id)
    {
        $query->select(['terms.*']);
        $query->join('termables', 'termables.term_id', '=', 'terms.id');
        $query->where('termables.termable_type', $termable_type);
        $query->where('termables.termable_id', $termable_id);
        $query->orderBy('termables.position');

        return $query;
    }

    /**
     * Return terms not associated with termable
     *
     * @param $query
     * @param $termable_type
     * @param $termable_id
     * @return mixed
     */
    public function scopeNotTerm($query, $termable_type, $termable_id)
    {
        $query->select(['terms.*']);
        $query->leftJoin('termables', function ($subQB) use ($termable_type, $termable_id) {
            $subQB->on('termables.term_id', '=', 'terms.id');
            $subQB->where('termables.termable_id', $termable_id);
            $subQB->where('termables.termable_type', $termable_type);
        });
        $query->whereNull('termables.id');

        return $query;
    }

    /**
     * @return string
     */
    public function getDefaultUrlAttribute()
    {
        $url = ['terms'];

        foreach ($this->hierarchy as $item) {
            $url[] = $item['slug'];
        }

        return '/' . implode('/', $url);
    }

    /**
     * @deprecated
     */
    public function getUrlAttribute()
    {
        return $this->getDefaultUrlAttribute();
    }

}