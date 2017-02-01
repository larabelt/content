<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\PaginateRequest;

class PaginateTouts extends PaginateRequest
{
    public $perTout = 10;

    public $orderBy = 'touts.id';

    public $sortable = [
        'touts.id',
        'touts.name',
    ];

    public $searchable = [
        'touts.name',
    ];

}