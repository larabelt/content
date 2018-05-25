<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

class PaginatePosts extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Post::class;

    public $perPost = 10;

    public $orderBy = 'posts.id';

    public $sortable = [
        'posts.id',
        'posts.name',
        'posts.post_at',
        'posts.created_at',
        'posts.updated_at',
    ];

    public $searchable = [
        'posts.name',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Core\Pagination\IsActiveQueryModifier::class,
        Belt\Content\Pagination\TermableQueryModifier::class,
    ];

    public function modifyQuery(Builder $query)
    {
        if ($post_at_year = $this->get('post_at_year')) {
            $query->whereBetween('post_at', ["$post_at_year-01-01 00:00:00", "$post_at_year-12-31 23:59:59"]);
        }

        return $query;
    }

}