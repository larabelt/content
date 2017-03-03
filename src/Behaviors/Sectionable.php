<?php
namespace Belt\Content\Behaviors;

/**
 * Class Sectionable
 * @package Belt\Content\Behaviors
 */
trait Sectionable
{
    /**
     * @return string
     */
    public function getSectionName()
    {
        $type = str_singular($this->getMorphClass());

        return sprintf('%s: %s', $type, $this->name);
    }

}