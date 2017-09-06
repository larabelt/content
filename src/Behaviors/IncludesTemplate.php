<?php

namespace Belt\Content\Behaviors;

use Belt\Core\Behaviors\ParamableInterface;
use Belt\Core\Helpers\ArrayHelper;

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
     * @param $value
     *
     * @return string
     */
    public function getTemplateAttribute($value)
    {
        return $value ?: 'default';
    }

    /**
     * @return string
     */
    public function getTemplateConfigPrefix()
    {
        return sprintf('belt.templates.%s', $this->getTemplateGroup());
    }

    /**
     * @return string
     */
    public function getDefaultTemplateKey()
    {
        $prefix = $this->getTemplateConfigPrefix();

        $configs = config($prefix);

        if (isset($configs['default']) || !count($configs)) {
            return 'default';
        }

        return array_keys($configs)[0];
    }

    /**
     * @return mixed
     */
    public function getTemplateGroup()
    {
        return $this->getMorphClass();
    }

    /**
     * @param null $key
     * @param null $default
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateConfig($key = null, $default = null)
    {
        $prefix = $this->getTemplateConfigPrefix();

        $config = config(sprintf('%s.%s', $prefix, $this->template));

        if (!$config) {
            $config = config(sprintf('%s.%s', $prefix, $this->getDefaultTemplateKey()));
        }

        if (!$config) {
            throw new \Exception("missing template config: $prefix.$this->template");
        }

        if ($key) {
            return array_get($config, $key, $default);
        }

        return $config;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateViewAttribute()
    {
        $config = $this->getTemplateConfig();

        return is_array($config) ? array_get($config, 'path', array_get($config, 0)) : $config;
    }

    /**
     * @todo need other method to purge orphaned params
     */
    public function reconcileTemplateParams()
    {
        if (!$this instanceof ParamableInterface) {
            return;
        }

        $this->load('params');

        $config = $this->getTemplateConfig();

        foreach (array_get($config, 'params', []) as $key => $values) {

            $default = '';
            $param = $this->params->where('key', $key)->first();

            if (is_array($values)) {
                $values = ArrayHelper::isAssociative($values) ? array_keys($values) : $values;
                $default = $values[0];
                if ($param && $param->value && !in_array($param->value, $values)) {
                    $param->update(['value' => $default]);
                }
            }

            if (!$param) {
                $this->params()->create(['key' => $key, 'value' => $default]);
            }
        }

    }

    /**
     * Binds events to subclass
     */
    public static function bootIncludesTemplate()
    {
        static::saved(function ($item) {
            $item->reconcileTemplateParams();
        });
    }

}