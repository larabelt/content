<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package Belt\Content
 */
class Post extends Model implements
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
    protected $morphClass = 'posts';

    /**
     * @var string
     */
    protected $table = 'posts';

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
    protected $dates = ['post_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @var array
     */
    protected $appends = ['image', 'morph_class', 'default_url', 'is_public'];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->__toSearchableArray();
        $array['is_active'] = $this->is_public;
        $array['categories'] = $this->categories ? $this->categories->pluck('id')->all() : null;
        $array['tags'] = $this->tags ? $this->tags->pluck('id')->all() : null;

        return $array;
    }

    /**
     * Is post publicly available
     *
     * @return bool
     */
    public function getIsPublicAttribute()
    {
        if ($this->is_active && $this->post_at && $this->post_at->isPast()) {
            return true;
        }

        return false;
    }

    /**
     * Return tags associated with taggable
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsPublic($query, $datetime = null)
    {
        $datetime = $datetime ?: date('Y-m-d H:i:s');

        $query->where('posts.is_active', true);
        $query->where('posts.post_at', '<', $datetime);

        return $query;
    }

    /**
     * @param $post
     * @return Model
     */
    public static function copy($post)
    {
        $post = $post instanceof Post ? $post : self::sluggish($post)->first();

        $clone = $post->replicate();
        $clone->slug .= '-' . strtotime('now');
        $clone->push();

        foreach ($post->sections as $section) {
            Section::copy($section, ['owner_id' => $clone->id]);
        }

        foreach ($post->attachments as $attachment) {
            $clone->attachments()->attach($attachment);
        }

        foreach ($post->categories as $category) {
            $clone->categories()->attach($category);
        }

        foreach ($post->handles as $handle) {
            Handle::copy($handle, ['handleable_id' => $clone->id]);
        }

        foreach ($post->tags as $tag) {
            $clone->tags()->attach($tag);
        }

        return $clone;
    }
}