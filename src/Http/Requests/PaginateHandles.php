<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateHandles extends PaginateRequest
{
    public $perPage = 10;

    public $orderBy = 'handles.id';

    public $sortable = [
        'handles.id',
        'handles.url',
        'handles.hits',
        'handles.is_active',
        'handles.target',
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
        Belt\Core\Pagination\IsActiveQueryModifier::class,
    ];

    public function modifyQuery(Builder $query)
    {
//        if ($status = $this->query->has('status')) {
//            $query->where('status', $this->query->get('status'));
//        }

        if ($handleable_id = $this->get('handleable_id')) {
            $query->where('handleable_id', $handleable_id);
        }

        if ($handleable_type = $this->get('handleable_type')) {
            $query->where('handleable_type', $handleable_type);
        }

        return $query;
    }

}