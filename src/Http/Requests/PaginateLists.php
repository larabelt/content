<?php
namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;

class PaginateLists extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Lyst::class;

    public $perList = 10;

    public $orderBy = 'lists.id';

    public $sortable = [
        'lists.id',
        'lists.name',
        'lists.rating',
        'lists.created_at',
        'lists.updated_at',
    ];

    public $searchable = [
        'lists.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Core\Pagination\PriorityQueryModifier::class,
        Belt\Core\Pagination\TeamableQueryModifier::class,
        Belt\Content\Pagination\TermableQueryModifier::class,
    ];

}