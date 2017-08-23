<?php

namespace Belt\Content\Observers;

use Belt\Core\Param;
use Belt\Content\Behaviors\IncludesTemplateInterface;

class ParamObserver
{
    /**
     * Listen to the Param deleting event.
     *
     * @param  Param $param
     * @return void
     */
    public function deleted(Param $param)
    {
        $owner = $param->owner;
        if ($owner && $owner instanceof IncludesTemplateInterface) {
            $owner->reconcileTemplateParams();
        }
    }
}