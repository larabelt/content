<?php
namespace Belt\Content\Behaviors;

/**
 * Interface IncludesSeoInterface
 * @package Belt\Content\Behaviors
 */
interface IncludesSeoInterface
{

    /**
     * @param $value
     * @return mixed
     */
    public function setMetaTitleAttribute($value);

    /**
     * @param $value
     * @return mixed
     */
    public function setMetaKeywordsAttribute($value);

    /**
     * @param $value
     * @return mixed
     */
    public function setMetaDescriptionAttribute($value);

    /**
     * @param $value
     * @return mixed
     */
    public function getMetaTitleAttribute($value);

}