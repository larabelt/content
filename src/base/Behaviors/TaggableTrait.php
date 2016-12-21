<?php
namespace Ohio\Content\Base\Behaviors;

use Ohio\Content\Tag\Tag;

trait TaggableTrait
{

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}