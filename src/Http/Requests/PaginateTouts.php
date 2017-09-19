<?php
namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;

class PaginateTouts extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Tout::class;

    public $perTout = 10;

    public $orderBy = 'touts.id';

    public $sortable = [
        'touts.id',
        'touts.name',
        'touts.heading',
    ];

    public $searchable = [
        'touts.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Glue\Pagination\TaggableQueryModifier::class,
    ];

}