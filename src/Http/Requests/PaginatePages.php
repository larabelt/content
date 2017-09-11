<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;

class PaginatePages extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Page::class;

    public $perPage = 10;

    public $orderBy = 'pages.id';

    public $sortable = [
        'pages.id',
        'pages.name',
    ];

    public $searchable = [
        'pages.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Core\Pagination\IsActiveQueryModifier::class,
        Belt\Glue\Pagination\CategorizableQueryModifier::class,
        Belt\Glue\Pagination\TaggableQueryModifier::class,
    ];

}