<?php

namespace Belt\Content;

use Belt;
use Belt\Clip\Attachment;
use Belt\Content\Handle;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\BelongsToSortedManyTrait;

/**
 * Class Lyst
 * @package Belt\Content
 */
class Lyst extends Model implements
    Belt\Core\Behaviors\IsSearchableInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\PriorityInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Core\Behaviors\TeamableInterface,
    Belt\Core\Behaviors\TypeInterface,
    Belt\Clip\Behaviors\ClippableInterface,
    Belt\Content\Behaviors\HasSectionsInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Content\Behaviors\SectionableInterface,
    Belt\Content\Behaviors\TermableInterface,
    Belt\Content\Behaviors\HandleableInterface
{
    use BelongsToSortedManyTrait;
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IsSearchable;
    use Belt\Core\Behaviors\PriorityTrait;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\Teamable;
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Clip\Behaviors\Clippable;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\HasSections;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Content\Behaviors\IncludesTemplate;
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
    protected $appends = ['image', 'type', 'default_url', 'morph_class'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->__toSearchableArray();
        $array['categories'] = $this->categories ? $this->categories->pluck('id')->all() : null;
        $array['tags'] = $this->tags ? $this->tags->pluck('id')->all() : null;

        return $array;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function places()
    {
        return $this->hasMany(Listable::class)->orderBy('position');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listables()
    {
        return $this->hasMany(Listable::class)->with('place')->orderBy('position');
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
        $clone->slug .= '-' . strtotime('now');
        $clone->push();

        Lyst::unguard();

        foreach ($list->listables as $listable) {
            $clone->listables()->create([
                'place_id' => $listable->place_id,
                'position' => $listable->position,
                'heading' => $listable->heading,
                'body' => $listable->body,
            ]);
        }

        foreach ($list->sections as $section) {
            Section::copy($section, ['owner_id' => $clone->id]);
        }

        foreach ($list->attachments as $attachment) {
            $clone->attachments()->attach($attachment);
        }

        foreach ($list->categories as $category) {
            $clone->categories()->attach($category);
        }

        foreach ($list->handles as $handle) {
            Handle::copy($handle, ['handleable_id' => $clone->id]);
        }

        foreach ($list->tags as $tag) {
            $clone->tags()->attach($tag);
        }

        return $clone;
    }

}