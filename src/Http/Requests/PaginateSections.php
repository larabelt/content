<?php
namespace Ohio\Content\Http\Requests;

use Ohio\Core\Http\Requests\PaginateRequest;

class PaginateSections extends PaginateRequest
{
    public $perSection = 10;

    public $orderBy = 'sections.id';

    public $sortable = [
        'sections.id',
        'sections.name',
    ];

    public $searchable = [
        'sections.name',
    ];

}