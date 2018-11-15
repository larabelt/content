<?php

namespace Belt\Content\Behaviors;

use Belt, Translate;
use Belt\Content\Handle;

/**
 * Class Handleable
 * @package Belt\Content\Behaviors
 */
trait Handleable
{

    /**
     * Binds events to subclass
     */
    public static function bootHandleable()
    {
        static::observe(Belt\Content\Observers\HandleableObserver::class);
    }

    /**
     * @return mixed
     */
    public function getHandleAttribute()
    {
        $handle = null;

        if (Translate::isEnabled()) {
            $handle = $this->handles->where('is_default', true)->where('locale', Translate::getLocale())->first();
            $handle = $handle ?: $this->handles->where('locale', Translate::getLocale())->first();
        }

        $handle = $handle ?: $this->handles->where('is_default', true)->first();

        return $handle ?: new Handle([
            'url' => sprintf('/%s/%s/%s', $this->getMorphClass(), $this->id, $this->slug),
        ]);
    }

    /**
     * @return mixed
     */
    public function handles()
    {
        return $this->morphMany(Handle::class, 'handleable')->orderBy('is_default', 'desc');
    }

    /**
     * @return string
     */
    public function getDefaultUrlAttribute()
    {
        $url = $this->handle->url;

        if ($this->handle->subtype == 'alias' && Translate::isEnabled()) {
            //$url = $this->handle->prefixed_url;
            $url = $this->handle->replaced_url;
        }

        return $url;
    }

}