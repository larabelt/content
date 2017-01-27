<?php
namespace Ohio\Content\Tag\Http\Requests;

use Ohio\Core\Base\Http\Requests\PaginateRequest;

class PaginateTags extends PaginateRequest
{
    public $perTag = 10;

    public $orderBy = 'tags.id';

    public $sortable = [
        'tags.id',
        'tags.name',
    ];

    public $searchable = [
        'tags.name',
    ];

}