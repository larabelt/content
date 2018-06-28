<?php
namespace Belt\Content\Behaviors;

/**
 * Interface ClippableInterface
 * @package Belt\Content\Behaviors
 */
interface ClippableInterface
{

    /**
     * @return mixed
     */
    public static function getResizePresets();

    /**
     * @return mixed
     */
    public function attachments();

}