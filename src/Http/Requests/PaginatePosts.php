<?php

namespace Belt\Content\Http\Requests;

use Belt\Content\Post;
use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Glue\Http\Requests\PaginateCategorizables;
use Belt\Glue\Http\Requests\PaginateTaggables;
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

    public function modifyQuery(Builder $query)
    {
        $query = PaginateCategorizables::scopeHasCategory($this, $query);
        $query = PaginateTaggables::scopeHasTag($this, $query);

        if ($is_active = $this->get('is_active')) {
            $query->where('is_active', $is_active);
        }

        if ($post_at_year = $this->get('post_at_year')) {
            $query->whereBetween('post_at', ["$post_at_year-01-01 00:00:00", "$post_at_year-12-31 23:59:59"]);
        }

        return $query;
    }

}