<?php

namespace Belt\Content\Resources\Subtypes;

use Belt;

/**
 * Class BaseList
 * @package Belt\Core\Resources\Params
 */
class BaseList extends Belt\Core\Resources\BaseSubtype
{
    use Belt\Content\Resources\Traits\HasListItems;

    /**
     * @return mixed
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['list_items'] = $this->getListItems();

        return $array;
    }
}