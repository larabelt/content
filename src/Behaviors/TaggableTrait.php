<?php
namespace Ohio\Content\Behaviors;

use Ohio\Content\Tag;

trait TaggableTrait
{

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}