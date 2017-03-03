<?php
namespace Belt\Content\Behaviors;

/**
 * Class IncludesTemplate
 * @package Belt\Content\Behaviors
 */
trait IncludesTemplate
{

    /**
     * @param $value
     */
    public function setTemplateAttribute($value)
    {
        $this->attributes['template'] = trim(strtolower($value));
    }

    /**
     * @return mixed
     */
    public function getTemplateGroup()
    {
        return $this->getMorphClass();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateConfig($key = null, $default = null)
    {
        $key = sprintf('belt.templates.%s', $this->getTemplateGroup());

        $config = config("$key.$this->template") ?: config("$key.default");

        if (!$config) {
            throw new \Exception("missing template config: $key.$this->template");
        }

        return $config;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateViewAttribute()
    {
        $key = sprintf('belt.templates.%s', $this->getTemplateGroup());

        $config = config("$key.$this->template") ?: config("$key.default");

        if (!$config) {
            throw new \Exception("missing template view: $key.$this->template");
        }

        return is_array($config) ? array_get($config, 'path', array_get($config, 0)) : $config;
    }

}