<?php
namespace Ohio\Content\Base\Behaviors;

trait ContentTrait
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