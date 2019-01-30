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

    private $translatedLinks;

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
    public function handles()
    {
        return $this->morphMany(Handle::class, 'handleable')->orderBy('is_default', 'desc');
    }

    /**
     * @param bool $translate
     * @param null $locale
     * @return Handle
     */
    public function getHandle($translate = true, $locale = null)
    {
        $handle = null;

        if ($translate && Translate::isEnabled()) {
            $locale = $locale ?: Translate::getLocale();
            $handle = $this->handles->where('is_default', true)->where('locale', $locale)->first();
            $handle = $handle ?: $this->handles->where('locale', $locale)->first();
        }

        $handle = $handle ?: $this->handles->where('is_default', true)->first();

        if (!$handle) {
            Handle::unguard();

            $slug = $this->getOriginal('slug');
            if ($translate && $this instanceof Belt\Core\Behaviors\TranslatableInterface) {
                if ($translation = $this->translations->where('translatable_column', 'slug')->where('locale', $locale)->first()) {
                    $slug = $translation->value;
                }
            }

            $handle = new Handle([
                'subtype' => 'alias',
                'handleable_type' => $this->getMorphClass(),
                'handleable_id' => $this->id,
                'url' => sprintf('/%s/%s/%s', $this->getMorphClass(), $this->id, $slug),
            ]);
        }

        return $handle;
    }

    /**
     * @return mixed
     */
    public function getHandleAttribute()
    {
        return $this->getHandle();
    }

    /**
     * @return string
     */
    public function getDefaultUrlAttribute()
    {
        $url = $this->handle->url;

        if ($this->handle->subtype == 'alias' && Translate::isEnabled()) {
            $url = $this->handle->replaced_url;
        }

        return $url;
    }

    /**
     * @return string
     */
    public function getSimpleUrlAttribute()
    {
        $url = sprintf('/%s/%s/%s', $this->getMorphClass(), $this->id, $this->slug);

        if (Translate::isEnabled()) {
            $url = Belt\Core\Helpers\UrlHelper::normalize(Translate::getLocale() . $url);
        }

        return $url;
    }

    /**
     * @return array
     */
    public function getTranslatedLinks()
    {
        if (!is_null($this->translatedLinks)) {
            return $this->translatedLinks;
        }

        $links = [];
        foreach (Translate::getAvailableLocales() as $locale) {
            $handle = $this->getHandle(true, $locale['code']);
            $links[$locale['code']] = Translate::prefixUrls() ? $handle->getReplacedUrl($locale['code']) : $handle->url;
        }

        return $this->translatedLinks = $links;
    }

}