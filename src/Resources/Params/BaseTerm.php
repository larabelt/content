<?php

namespace Belt\Content\Resources\Params;

use Belt;

/**
 * Class BaseTerm
 * @package Belt\Core\Resources\Params
 */
class BaseTerm extends Belt\Core\Resources\BaseParam
{
    protected $type = 'terms';
    protected $label = 'Term';
    protected $description = 'Link existing term to this item.';
}