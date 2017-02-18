<?php
namespace Belt\Content\Behaviors;

/**
 * Class IncludesSeo
 * @package Belt\Content\Behaviors
 */
trait IncludesSeo
{

    /**
     * @param $value
     */
    public function setMetaTitleAttribute($value)
    {
        $this->attributes['meta_title'] = trim($value);
    }

    /**
     * @param $value
     */
    public function setMetaKeywordsAttribute($value)
    {
        $this->attributes['meta_keywords'] = trim($value);
    }

    /**
     * @param $value
     */
    public function setMetaDescriptionAttribute($value)
    {
        $this->attributes['meta_description'] = trim($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->name;
    }

}