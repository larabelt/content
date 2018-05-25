<?php

namespace Belt\Spot;

use Belt;
use Belt\Clip\Attachment;
use Belt\Content\Handle;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\BelongsToSortedManyTrait;

/**
 * Class Itinerary
 * @package Belt\Spot
 */
class Itinerary extends Model implements
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
    Belt\Content\Behaviors\HandleableInterface,
    Belt\Spot\Behaviors\RateableInterface
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
    use Belt\Spot\Behaviors\Rateable;

    /**
     * @var string
     */
    protected $morphClass = 'itineraries';

    /**
     * @var string
     */
    protected $table = 'itineraries';

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
        return $this->hasMany(ItineraryPlace::class)->orderBy('position');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itineraryPlaces()
    {
        return $this->hasMany(ItineraryPlace::class)->with('place')->orderBy('position');
    }

    /**
     * @param $itinerary
     * @return Model
     */
    public static function copy($itinerary)
    {
        $itinerary = $itinerary instanceof Itinerary ? $itinerary : self::sluggish($itinerary)->first();

        /**
         * @var $clone Itinerary
         */
        $clone = $itinerary->replicate();
        $clone->slug .= '-' . strtotime('now');
        $clone->push();

        Itinerary::unguard();

        foreach ($itinerary->itineraryPlaces as $itineraryPlace) {
            $clone->itineraryPlaces()->create([
                'place_id' => $itineraryPlace->place_id,
                'position' => $itineraryPlace->position,
                'heading' => $itineraryPlace->heading,
                'body' => $itineraryPlace->body,
            ]);
        }

        foreach ($itinerary->sections as $section) {
            Section::copy($section, ['owner_id' => $clone->id]);
        }

        foreach ($itinerary->attachments as $attachment) {
            $clone->attachments()->attach($attachment);
        }

        foreach ($itinerary->categories as $category) {
            $clone->categories()->attach($category);
        }

        foreach ($itinerary->handles as $handle) {
            Handle::copy($handle, ['handleable_id' => $clone->id]);
        }

        foreach ($itinerary->tags as $tag) {
            $clone->tags()->attach($tag);
        }

        return $clone;
    }

}