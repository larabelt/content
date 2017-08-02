<?php
namespace Belt\Content\Behaviors;

/**
 * Interface IncludesTemplateInterface
 * @package Belt\Content\Behaviors
 */
interface IncludesTemplateInterface
{

    /**
     * @param $value
     */
    public function setTemplateAttribute($value);

    /**
     * @param $value
     *
     * @return string
     */
    public function getTemplateAttribute($value);

    /**
     * @return string
     */
    public function getTemplateConfigPrefix();

    /**
     * @return string
     */
    public function getDefaultTemplateKey();

    /**
     * @return mixed
     */
    public function getTemplateGroup();

    /**
     * @param null $key
     * @param null $default
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateConfig($key = null, $default = null);

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateViewAttribute();

    /**
     * @todo need other method to purge orphaned params
     */
    public function reconcileTemplateParams();

}