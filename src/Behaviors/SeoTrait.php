<?php
namespace Ohio\Content\Behaviors;

trait SeoTrait
{

    public function setMetaTitleAttribute($value)
    {
        $this->attributes['meta_title'] = trim($value);
    }

    public function setMetaKeywordsAttribute($value)
    {
        $this->attributes['meta_keywords'] = trim($value);
    }

    public function setMetaDescriptionAttribute($value)
    {
        $this->attributes['meta_description'] = trim($value);
    }

    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->name;
    }

}