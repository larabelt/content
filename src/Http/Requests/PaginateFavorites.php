<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginateFavorites extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Favorite::class;

    public $perPage = 100;

    public $orderBy = 'favorites.id';

    public $sortable = [
        'favorites.id',
        'favorites.created_at',
        'favorites.updated_at',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
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