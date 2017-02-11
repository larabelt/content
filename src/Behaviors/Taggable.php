<?php
namespace Ohio\Content\Behaviors;

use Ohio\Content\Tag;

trait Taggable
{

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}