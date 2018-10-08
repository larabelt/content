<?php

namespace Belt\Content\Resources\Params;

use Belt;

/**
 * Class BasePage
 * @package Belt\Core\Resources\Params
 */
class BasePage extends Belt\Core\Resources\BaseParam
{
    protected $type = 'pages';
    protected $label = 'Page';
    protected $description = 'Link existing page to this item.';
}