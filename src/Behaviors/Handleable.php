<?php

namespace Belt\Content\Behaviors;

use Belt\Content\Handle;

/**
 * Class Handleable
 * @package Belt\Content\Behaviors
 */
trait Handleable
{

    /**
     * @return mixed
     */
    public function handle()
    {
        return $this->morphOne(Handle::class, 'handleable')->where('delta', 1.00);
    }

    /**
     * @return mixed
     */
    public function handles()
    {
        return $this->morphMany(Handle::class, 'handleable')->orderby('delta');
    }

    /**
     * @return string
     */
    public function getDefaultUrlAttribute()
    {
        if ($this->handle) {
            return $this->handle->url;
        }

        return sprintf('%s/%s/%s', $this->getMorphClass(), $this->id, $this->slug);
    }
}