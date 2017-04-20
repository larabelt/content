<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginatePosts extends PaginateRequest
{
    public $perPost = 10;

    public $orderBy = 'posts.id';

    public $sortable = [
        'posts.id',
        'posts.name',
    ];

    public $searchable = [
        'posts.name',
        'posts.searchable',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\IsActiveQueryModifier::class,
        Belt\Glue\Pagination\CategorizableQueryModifier::class,
        Belt\Glue\Pagination\TaggableQueryModifier::class,
    ];

    public function modifyQuery(Builder $query)
    {
        if ($post_at_year = $this->get('post_at_year')) {
            $query->whereBetween('post_at', ["$post_at_year-01-01 00:00:00", "$post_at_year-12-31 23:59:59"]);
        }

        return $query;
    }

}