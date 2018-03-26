<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateHandles extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Handle::class;

    public $perPage = 10;

    public $orderBy = 'handles.id';

    public $sortable = [
        'handles.id',
        'handles.url',
        'handles.hits',
        'handles.is_active',
        'handles.target',
        'handles.created_at',
        'handles.updated_at',
    ];

    public $searchable = [
        'handles.url',
        'handles.target',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Core\Pagination\IsActiveQueryModifier::class,
    ];

    public function modifyQuery(Builder $query)
    {

        if ($handleable_id = $this->get('handleable_id')) {
            $query->where('handleable_id', $handleable_id);
        }

        if ($handleable_type = $this->get('handleable_type')) {
            $query->where('handleable_type', $handleable_type);
        }

        return $query;
    }

}