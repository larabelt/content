<?php
namespace Belt\Content\Behaviors;

/**
 * Interface HasSectionsInterface
 * @package Belt\Content\Behaviors
 */
interface HasSectionsInterface
{

    /**
     * @return mixed
     */
    public function sections();

    /**
     * @return string
     */
    public function getHasSectionsCacheKey();

}