<?php
namespace Ohio\Content\Block\Http\Requests;

use Ohio\Core\Base\Http\Requests\BasePaginateRequest;

class PaginateRequest extends BasePaginateRequest
{
    public $perBlock = 10;

    public $orderBy = 'blocks.id';

    public $sortable = [
        'blocks.id',
        'blocks.name',
    ];

    public $searchable = [
        'blocks.name',
    ];

}