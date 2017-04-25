<?php
namespace Belt\Content\Behaviors;

/**
 * Interface HandleableInterface
 * @package Belt\Content\Behaviors
 */
interface HandleableInterface
{

//    /**
//     * @return mixed
//     */
//    public function handle();

    /**
     * @return mixed
     */
    public function getHandleAttribute();

    /**
     * @return mixed
     */
    public function handles();

}