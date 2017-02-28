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
        return sprintf('%s: %s', str_singular($this->morphClass), $this->slug);
    }

}