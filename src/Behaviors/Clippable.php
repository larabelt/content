<?php

namespace Belt\Content\Behaviors;

use Belt, DB;
use Belt\Content\Attachment;

/**
 * Class Clippable
 * @package Belt\Content\Behaviors
 */
trait Clippable
{
    /**
     * @return array
     */
    public function getResizePresets()
    {
        return $this->getTemplateConfig('resizes.presets');
    }

//    /**
//     * @todo need 2 classes for single attachments vs collections
//     *
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     */
//    public function attachment()
//    {
//        return $this->belongsTo(Attachment::class);
//    }

    /**
     * @return \Rutorika\Sortable\BelongsToSortedMany
     */
    public function attachments()
    {
        return $this->morphToSortedMany(Attachment::class, 'clippable')->withPivot('position');
    }

//    /**
//     * purge related items in clippables table
//     */
//    public function purgeAttachments()
//    {
//        DB::connection($this->getConnectionName())
//            ->table('clippables')
//            ->where('clippable_id', $this->id)
//            ->where('clippable_type', $this->getMorphClass())
//            ->delete();
//    }

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