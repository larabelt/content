<?php
namespace Ohio\Content\Handle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
        $this->attributes['url'] = trim(strtolower($value));
    }

}