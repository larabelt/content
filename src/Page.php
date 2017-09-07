<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Page
 * @package Belt\Content
 */
class Page extends Model implements
    Belt\Core\Behaviors\IsSearchableInterface,
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\SluggableInterface,
    Belt\Core\Behaviors\TypeInterface,
    Belt\Content\Behaviors\HandleableInterface,
    Belt\Content\Behaviors\HasSectionsInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Content\Behaviors\IncludesTemplateInterface,
    Belt\Glue\Behaviors\CategorizableInterface,
    Belt\Glue\Behaviors\TaggableInterface,
    Belt\Clip\Behaviors\ClippableInterface
{
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IsSearchable;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Clip\Behaviors\Clippable;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\HasSections;
    use Belt\Content\Behaviors\IncludesTemplate;
    use Belt\Glue\Behaviors\Categorizable;
    use Belt\Glue\Behaviors\Taggable;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $morphClass = 'pages';

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var array
     */
    protected $with = ['handles'];

    /**
     * @var array
     */
    protected $appends = ['image', 'type', 'default_url', 'morph_class'];

    /**
     * @param $page
     * @return Model
     */
    public static function copy($page)
    {
        $page = $page instanceof Page ? $page : self::sluggish($page)->first();

        $clone = $page->replicate();
        $clone->slug .= '-' . strtotime('now');
        $clone->push();

        foreach ($page->sections as $section) {
            Section::copy($section, ['owner_id' => $clone->id]);
        }

        foreach ($page->attachments as $attachment) {
            $clone->attachments()->attach($attachment);
        }

        foreach ($page->categories as $category) {
            $clone->categories()->attach($category);
        }

        foreach ($page->handles as $handle) {
            Handle::copy($handle, ['handleable_id' => $clone->id]);
        }

        foreach ($page->tags as $tag) {
            $clone->tags()->attach($tag);
        }

        return $clone;
    }


}