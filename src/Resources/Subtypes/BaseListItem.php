<?php

namespace Belt\Content\Resources\Subtypes;

use Belt;

/**
 * Class BaseParam
 * @package Belt\Core\Resources\Params
 */
class BaseListItem extends Belt\Core\Resources\BaseSubtype
{
    use Belt\Core\Resources\Traits\HasTile;

    /**
     * @return mixed
     */
    public function toArray()
    {
        $array = parent::toArray();
        $array['tile'] = $this->getTile();

        return $array;
    }
}