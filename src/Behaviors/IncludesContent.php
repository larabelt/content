<?php
namespace Belt\Content\Behaviors;

/**
 * Class IncludesContent
 * @package Belt\Content\Behaviors
 */
trait IncludesContent
{
    /**
     * @param $value
     */
    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * @param $value
     */
    public function setIntroAttribute($value)
    {
        $this->attributes['intro'] = trim($value);
    }

    /**
     * @param $value
     */
    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = trim($value);
    }

}