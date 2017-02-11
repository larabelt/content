<?php
namespace Ohio\Content\Behaviors;

trait IncludesContent
{
    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = boolval($value);
    }

    public function setIntroAttribute($value)
    {
        $this->attributes['intro'] = trim($value);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = trim($value);
    }

}