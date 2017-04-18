<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;

class PaginateTouts extends PaginateRequest
{
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

}