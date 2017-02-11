<?php
namespace Ohio\Content\Behaviors;

trait IncludesTemplate
{

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function getTemplateViewAttribute()
    {
        $bits = explode("\\", get_class($this));

        $key = sprintf('ohio.%s.templates.%s', strtolower($bits[1]), $this->getMorphClass());

        return config("$key.$this->template.view") ?: config("$key.default.view");
    }

}