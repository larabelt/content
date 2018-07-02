<?php

namespace Belt\Content\Observers;

use Belt\Content\Behaviors\IncludesTemplateInterface;
use Belt\Content\Builders\BaseBuilder;

class IncludesTemplateObserver
{
    /**
     * Listen to the IncludesTemplateInterface created $item.
     *
     * @param  IncludesTemplateInterface $item
     * @return void
     */
    public function created(IncludesTemplateInterface $item)
    {
        /** @var $builder BaseBuilder */
        $class = $item->getTemplateConfig('builder');
        if ($class && class_exists($class) && !$item->getIsCopy()) {
            $builder = new $class($item);
            $builder->build();
        }
    }

    /**
     * Listen to the IncludesTemplateInterface saved $item.
     *
     * @param  IncludesTemplateInterface $item
     * @return void
     */
    public function saved(IncludesTemplateInterface $item)
    {
        $item->reconcileTemplateParams();
    }

}