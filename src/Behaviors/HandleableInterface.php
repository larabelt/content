<?php

namespace Belt\Content\Behaviors;

/**
 * Interface HandleableInterface
 * @package Belt\Content\Behaviors
 */
interface HandleableInterface
{

    /**
     * @return mixed
     */
    public function getHandleAttribute();

    /**
     * @return mixed
     */
    public function handles();

    /**
     * @return string
     */
    public function getDefaultUrlAttribute();

    /**
     * @return string
     */
    public function getSimpleUrlAttribute();

}