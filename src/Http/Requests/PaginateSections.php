<?php
namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateSections extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Section::class;

    public $perPage = 100;

    public $orderBy = 'sections._lft';

    public $sortable = [
        'sections.id',
        'sections.name',
    ];

    public $searchable = [
        'sections.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Core\Pagination\SubtypeQueryModifier::class,
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