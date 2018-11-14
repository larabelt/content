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
    Belt\Core\Behaviors\TranslatableInterface,
    Belt\Content\Behaviors\HandleableInterface,
    Belt\Content\Behaviors\HasSectionsInterface,
    Belt\Content\Behaviors\IncludesContentInterface,
    Belt\Content\Behaviors\IncludesSeoInterface,
    Belt\Core\Behaviors\IncludesSubtypesInterface,
    Belt\Content\Behaviors\TermableInterface,
    Belt\Content\Behaviors\ClippableInterface
{
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IsSearchable;
    use Belt\Core\Behaviors\Sluggable;
    use Belt\Core\Behaviors\TypeTrait;
    use Belt\Content\Behaviors\Clippable;
    use Belt\Content\Behaviors\IncludesSeo;
    use Belt\Content\Behaviors\IncludesContent;
    use Belt\Content\Behaviors\Handleable;
    use Belt\Content\Behaviors\HasSections;
    use Belt\Core\Behaviors\IncludesSubtypes;
    use Belt\Content\Behaviors\Termable;
    use Belt\Core\Behaviors\Translatable;
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
    protected $with = ['handles', 'params'];

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
        /* "terms" is seemingly reserved by elasticsearch */
        $array['categories'] = $this->terms ? $this->terms->pluck('id')->all() : null;

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
        $clone->setIsCopy(true);
        $clone->slug .= '-' . strtotime('now');
        $clone->push();

        foreach ($post->sections as $section) {
            Section::copy($section, ['owner_id' => $clone->id]);
        }

        foreach ($post->attachments as $attachment) {
            $clone->attachments()->attach($attachment);
        }

        foreach ($post->terms as $term) {
            $clone->terms()->attach($term);
        }

        foreach ($post->handles as $handle) {
            Handle::copy($handle, ['handleable_id' => $clone->id]);
        }

        foreach ($post->params as $param) {
            $clone->saveParam($param->key, $param->value);
        }

        return $clone;
    }
}