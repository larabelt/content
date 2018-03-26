<?php
namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;

class PaginateBlocks extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Block::class;

    public $perBlock = 10;

    public $orderBy = 'blocks.id';

    public $sortable = [
        'blocks.id',
        'blocks.name',
        'blocks.created_at',
        'blocks.updated_at',
    ];

    public $searchable = [
        'blocks.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
    ];

}