<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\BelongsToSortedManyTrait;

/**
 * Class Lyst
 * @package Belt\Content
 */
class Lyst extends Model implements
    Belt\Core\Behaviors\IsSearchableInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Core\Behaviors\TeamableInterface,
    Belt\Core\Behaviors\TypeInterface,
    Belt\Content\Behaviors\ClippableInterface,
    Belt\Content\Behaviors\HasSectionsInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Core\Behaviors\IncludesSubtypesInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Content\Behaviors\SectionableInterface,
    Belt\Content\Behaviors\TermableInterface,
    Belt\Content\Behaviors\HandleableInterface
{
    use BelongsToSortedManyTrait;
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IsSearchable;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\Teamable;
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Content\Behaviors\Clippable;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\HasSections;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Core\Behaviors\IncludesSubtypes;
    use Belt\Content\Behaviors\Sectionable;
    use Belt\Content\Behaviors\Termable;

    /**
     * @var string
     */
    protected $morphClass = 'lists';

    /**
     * @var string
     */
    protected $table = 'lists';

    /**
     * @var array
     */
    protected $fillable = ['name', 'body'];

    /**
     * @var array
     */
    protected $with = ['handles'];

    /**
     * @var array
     */
    protected $appends = ['morph_class', 'default_url'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->__toSearchableArray();
        /* "terms" is seemingly reserved by elasticsearch */
        $array['categories'] = $this->terms ? $this->terms->pluck('id')->all() : null;

        return $array;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(ListItem::class, 'list_id')->orderBy('position');
    }

    /**
     * @param $list
     * @return Model
     */
    public static function copy($list)
    {
        $list = $list instanceof Lyst ? $list : self::sluggish($list)->first();

        /**
         * @var $clone List
         */
        $clone = $list->replicate();
        $clone->setIsCopy(true);
        $clone->slug .= '-' . strtotime('now');
        $clone->push();

        Lyst::unguard();

        foreach ($list->items as $oldItem) {
            $newItem = $clone->items()->create([
                'subtype' => $oldItem->subtype,
                'position' => $oldItem->position,
            ]);
            foreach ($oldItem->params as $param) {
                $newItem->saveParam($param->key, $param->value);
            }
        }

        foreach ($list->sections as $section) {
            Belt\Content\Section::copy($section, ['owner_id' => $clone->id]);
        }

        foreach ($list->attachments as $attachment) {
            $clone->attachments()->attach($attachment);
        }

        foreach ($list->handles as $handle) {
            Belt\Content\Handle::copy($handle, ['handleable_id' => $clone->id]);
        }

        foreach ($list->terms as $term) {
            $clone->terms()->attach($term);
        }

        return $clone;
    }

}