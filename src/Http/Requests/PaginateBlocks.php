<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;

class PaginateBlocks extends PaginateRequest
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