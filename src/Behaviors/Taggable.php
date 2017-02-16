<?php
namespace Belt\Content\Behaviors;

use Belt\Content\Tag;

trait Taggable
{

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}