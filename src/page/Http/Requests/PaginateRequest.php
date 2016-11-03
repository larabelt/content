<?php
namespace Ohio\Content\Page\Http\Requests;

use Ohio\Core\Base\Http\Requests\BasePaginateRequest;

class PaginateRequest extends BasePaginateRequest
{
    public $perPage = 20;

    public $orderBy = 'pages.id';

    public $sortable = [
        'pages.id',
        'pages.name',
    ];

    public $searchable = [
        'pages.name',
    ];

}