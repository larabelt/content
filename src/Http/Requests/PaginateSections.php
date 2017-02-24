<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

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

    public function modifyQuery(Builder $query)
    {
        if ($this->get('page_id')) {
            $query->where('page_id', $this->get('page_id'));
        }

        return $query;
    }

}