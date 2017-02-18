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
     * @return mixed
     */
    public function setTemplateAttribute($value);

    /**
     * @return mixed
     */
    public function getTemplateViewAttribute();

}