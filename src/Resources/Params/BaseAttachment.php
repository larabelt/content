<?php

namespace Belt\Content\Resources\Params;

use Belt;

/**
 * Class BaseAttachment
 * @package Belt\Core\Resources\Params
 */
class BaseAttachment extends Belt\Core\Resources\BaseParam
{
    protected $type = 'attachments';
    protected $label = 'Attachment';
    protected $description = 'Link existing attachment to this item.';
}