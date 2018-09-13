<?php

namespace Belt\Content\Resources\Params;

use Belt;

/**
 * Class BaseList
 * @package Belt\Core\Resources\Params
 */
class BaseList extends Belt\Core\Resources\BaseParam
{
    protected $type = 'lists';
    protected $label = 'List';
    protected $description = 'Link existing list to this item.';
}