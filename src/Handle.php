<?php

namespace Belt\Content;

use Belt, Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Handle
 * @package Belt\Content
 */
class Handle extends Model implements
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\IncludesLocaleInterface,
    Belt\Core\Behaviors\IncludesSubtypesInterface
{
    use Belt\Core\Behaviors\IncludesLocale;
    use Belt\Core\Behaviors\IncludesSubtypes;

    /**
     * @var string
     */
    protected $morphClass = 'handles';

    /**
     * @var string
     */
    protected $table = 'handles';

    /**
     * @var array
     */
    protected $fillable = ['url'];

    /**
     * @var array
     */
    protected $with = ['params'];

    /**
     * @var array
     */
    protected $appends = ['config', 'prefixed_url'];

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function handleable()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->url;
    }

    /**
     * @param $value
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $this->normalizeUrl($value);
    }

    /**
     * @return string
     */
    public function getPrefixedUrlAttribute()
    {
        return Belt\Core\Helpers\UrlHelper::normalize($this->locale . $this->url);
    }

    /**
     * @param null $locale
     * @return string
     */
    public function getReplacedUrl($locale = null)
    {
        $locale = $locale ?: (Translate::isEnabled() ? Translate::getLocale() : $this->locale);

        return Belt\Core\Helpers\UrlHelper::normalize($locale . $this->url);
    }

    /**
     * @return string
     */
    public function getReplacedUrlAttribute()
    {
        return $this->getReplacedUrl();
    }

    /**
     * @param $value
     * @return mixed|string
     */
    public static function normalizeUrl($value)
    {

        $value = ltrim(trim($value), '/');

        // Convert all dashes/underscores into separator
        $value = preg_replace('![_]+!u', '-', $value);

        // Remove all characters that are not the separator, letters, numbers, whitespace or forward slashes
        $value = preg_replace('![^-\pL\pN\s/\//]+!u', '', mb_strtolower($value));

        // Replace all separator characters and whitespace by a single separator
        $value = preg_replace('![-\s]+!u', '-', $value);

        return '/' . $value;
    }

    /**
     * Return handles associated with handleable
     *
     * @param $query
     * @param $handleable_type
     * @param $handleable_id
     * @return mixed
     */
    public function scopeHandled($query, $handleable_type, $handleable_id)
    {
        $query->select(['handles.*']);
        $query->where('handles.handleable_type', $handleable_type);
        $query->where('handles.handleable_id', $handleable_id);

        return $query;
    }

    /**
     * @param $handle
     * @param array $options
     * @return Model
     */
    public static function copy($handle, $options = [])
    {
        $handle = $handle instanceof Handle ? $handle : self::find($handle)->first();

        $clone = $handle->replicate();
        $clone->handleable_id = array_get($options, 'handleable_id');
        $clone->url .= '-' . strtotime('now');
        $clone->push();

        return $clone;
    }

}