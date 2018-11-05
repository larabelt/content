<?php

namespace Belt\Content;

use Belt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Handle
 * @package Belt\Content
 */
class Handle extends Model implements
    Belt\Core\Behaviors\ParamableInterface,
    Belt\Core\Behaviors\IncludesSubtypesInterface
{
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
    protected $appends = ['config', 'params'];

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

//    /**
//     * @return mixed
//     */
//    public function getConfigAttribute()
//    {
//        return $this->config();
//    }
//
//    /**
//     * @param null $key
//     * @param null $default
//     * @return mixed
//     */
//    public function config($key = null, $default = null)
//    {
//        $config = ConfigHelper::config('belt.subtypes.handles', $this->subtype) ?: [];
//
//        if (!$key) {
//            return $config;
//        }
//
//        return array_get($config, $key, $default);
//    }

    /**
     * Ensure is_default is correctly handled
     */
    public function syncDefault()
    {
        if (!$this->handleable) {
            return;
        }

        if (!$this->getSubtypeConfig('show_default', false)) {
            return;
        }

        $count = $this->handled($this->handleable_type, $this->handleable_id)
            ->where('is_default', true)
            ->count();

        /**
         * There should only be one default, so if there is zero (or somehow more than one)
         * then this lucky duck becomes the default.
         */
        if ($this->is_default || $count != 1) {
            $this->is_default = true;
            $this->target = null;
            $this->save();

            /**
             * Ensure the rest have is_default=0
             */
            $this->handled($this->handleable_type, $this->handleable_id)
                ->where('id', '!=', $this->id)
                ->update(['is_default' => false]);
        }

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