<?php

namespace Belt\Content\Behaviors;

use Belt;
use Belt\Content\Attachment;

/**
 * Class Clippable
 * @package Belt\Content\Behaviors
 */
trait Clippable
{
    /**
     * Binds events to subclass
     */
    public static function bootClippable()
    {
        static::observe(Belt\Content\Observers\ClippableObserver::class);
    }

    /**
     * @return array
     */
    public function getResizePresets()
    {
        return $this->getSubtypeConfig('resizes.presets');
    }

    /**
     * @return \Rutorika\Sortable\BelongsToSortedMany
     */
    public function attachments()
    {
        return $this->morphToSortedMany(Attachment::class, 'clippable')->withPivot('position');
    }

    /**
     * @return Attachment
     */
    public function getImageAttribute()
    {
        foreach ($this->attachments as $attachment) {
            if ($attachment->isImage) {
                return $attachment;
            }
        }

        //return new Attachment();
    }

    /**
     * @return Attachment
     */
    public function getImagesAttribute()
    {
        $collection = collect();

        foreach ($this->attachments as $attachment) {
            if ($attachment->isImage) {
                $collection->push($attachment);
            }
        }

        return $collection;
    }

    /**
     * @param Attachment $attachment
     * @return $this
     */
    public function attachAttachment(Attachment $attachment)
    {
        try {
            if (!$this->attachments->contains($attachment->id)) {
                $this->attachments()->attach($attachment->id);
            }
        } catch (\Exception $e) {

        }

        $attachment->touch();

        return $this;
    }
}