<?php

namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateFavorites extends PaginateRequest
{
    public $perPage = 100;

    public $orderBy = 'favorites.id';

    public $sortable = [
        'favorites.id',
    ];

    public function modifyQuery(Builder $query)
    {
        if ($user_id = $this->get('user_id')) {
            $query->where('user_id', $user_id);
        }

        if ($guid = $this->get('guid')) {
            $query->where('guid', $guid);
        }

        return $query;
    }

}