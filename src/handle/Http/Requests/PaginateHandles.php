<?php
namespace Ohio\Content\Handle\Http\Requests;

use Ohio\Core\Base\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateHandles extends PaginateRequest
{
    public $perPage = 10;

    public $orderBy = 'handles.id';

    public $sortable = [
        'handles.id',
        'handles.url',
        'handles.delta',
    ];

    public $searchable = [
        'handles.url',
    ];

    public function modifyQuery(Builder $query)
    {
        if ($this->get('delta')) {
            $query->where('delta', $this->get('delta'));
        }

        if ($this->get('handleable_id')) {
            $query->where('handleable_id', $this->get('handleable_id'));
        }

        if ($this->get('handleable_type')) {
            $query->where('handleable_type', $this->get('handleable_type'));
        }

        return $query;
    }

}