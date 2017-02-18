<?php
namespace Belt\Content\Behaviors;

/**
 * Interface IncludesContentInterface
 * @package Belt\Content\Behaviors
 */
interface IncludesContentInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function setIsActiveAttribute($value);

    /**
     * @param $value
     * @return mixed
     */
    public function setIntroAttribute($value);

    /**
     * @param $value
     * @return mixed
     */
    public function setBodyAttribute($value);

}