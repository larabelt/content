<?php
namespace Ohio\Content\Handle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Handle extends Model
{
    protected $table = 'handles';

    protected $guarded = ['id'];

    /**
     * The Associated owning model
     *
     * @return MorphTo|Model
     */
    public function handleable()
    {
        return $this->morphTo();
    }

    public function __toString()
    {
        return $this->url;
    }

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $this->normalizeUrl($value);
    }

    public static function normalizeUrl($value)
    {

        $value = ltrim(trim($value), '/');

        $value = Str::ascii($value);

        // Convert all dashes/underscores into separator
        $value = preg_replace('![_]+!u', '-', $value);

        // Remove all characters that are not the separator, letters, numbers, whitespace or forward slashes
        $value = preg_replace('![^-\pL\pN\s/\//]+!u', '', mb_strtolower($value));

        // Replace all separator characters and whitespace by a single separator
        $value = preg_replace('![-\s]+!u', '-', $value);

        return $value;
    }

}