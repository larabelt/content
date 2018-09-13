<?php

namespace Belt\Content\Resources\Params;

use Belt;

/**
 * Class BaseBlock
 * @package Belt\Core\Resources\Params
 */
class BaseBlock extends Belt\Core\Resources\BaseParam
{
    protected $type = 'blocks';
    protected $label = 'Block';
    protected $description = 'Link existing block to this item.';
}