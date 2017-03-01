<?php
namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateSections extends PaginateRequest
{
    public $perPage = 100;

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
        $query->whereNull('parent_id');

        if ($this->get('owner_id')) {
            $query->where('owner_id', $this->get('owner_id'));
        }

        if ($this->get('owner_type')) {
            $query->where('owner_type', $this->get('owner_type'));
        }

        return $query;
    }

}