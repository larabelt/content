<?php

namespace Ohio\Content\Page\Http\Controllers\Api;

use Ohio\Content\Page\Page;
use Ohio\Core\Base\Http\Controllers\BaseApiController;

use Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait;

class TagsController extends BaseApiController
{

    use TaggableControllerTrait;

    public $taggable_class = Page::class;

}