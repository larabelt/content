<?php

namespace Belt\Content\Http\Requests;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Glue\Http\Requests\PaginateCategorizables;
use Belt\Glue\Http\Requests\PaginateTaggables;
use Illuminate\Database\Eloquent\Builder;

class PaginatePages extends PaginateRequest
{
    public $perPage = 10;

    public $orderBy = 'pages.id';

    public $sortable = [
        'pages.id',
        'pages.name',
    ];

    public $searchable = [
        'pages.name',
        'pages.searchable',
    ];

    public function modifyQuery(Builder $query)
    {
        $query = PaginateCategorizables::scopeHasCategory($this, $query);
        $query = PaginateTaggables::scopeHasTag($this, $query);

        if ($is_active = $this->get('is_active')) {
            $query->where('is_active', $is_active);
        }

        return $query;
    }

}