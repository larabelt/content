<?php

namespace Belt\Content\Resources\Subtypes;

use Belt;

/**
 * Class BasePage
 * @package Belt\Core\Resources\Params
 */
class BasePage extends Belt\Core\Resources\BaseSubtype
{
    use Belt\Core\Resources\Traits\HasForceCompile,
        Belt\Core\Resources\Traits\HasSectionable;

    /**
     * @return mixed
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['force_compile'] = $this->isForceCompile();
        $array['sectionable'] = $this->isSectionable();

        return $array;
    }
}