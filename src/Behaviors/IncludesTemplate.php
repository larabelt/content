<?php
namespace Ohio\Content\Behaviors;

trait IncludesTemplate
{

    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    public function getTemplateGroup()
    {
        return $this->getMorphClass();
    }

    public function getTemplateViewAttribute()
    {
        $key = sprintf('ohio.templates.%s', $this->getTemplateGroup());

        $config = config("$key.$this->template") ?: config("$key.default");

        if (!$config) {
            throw new \Exception('missing template view');
        }

        return is_array($config) ? $config[0] : $config;
    }

}