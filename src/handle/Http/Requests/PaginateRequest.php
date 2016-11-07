<?php
namespace Ohio\Content\Handle\Http\Requests;

use Ohio\Core\Base\Http\Requests\BasePaginateRequest;

class PaginateRequest extends BasePaginateRequest
{
    public $perHandle = 10;

    public $orderBy = 'handles.id';

    public $sortable = [
        'handles.id',
        'handles.name',
    ];

    public $searchable = [
        'handles.name',
    ];

}