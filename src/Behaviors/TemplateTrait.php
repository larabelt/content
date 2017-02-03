<?php
namespace Ohio\Content\Behaviors;

trait TemplateTrait
{

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

}