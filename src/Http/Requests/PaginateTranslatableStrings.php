<?php

namespace Belt\Content\Http\Requests;

use Belt;

class PaginateTranslatableStrings extends Belt\Core\Http\Requests\PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Core\Role::class;

    public $perPage = 100;

    public $orderBy = 'translatable_strings.value';

    public $sortable = [
        'translatable_strings.id',
        'translatable_strings.value',
        'translatable_strings.created_at',
        'translatable_strings.updated_at',
    ];

    public $searchable = [
        'translatable_strings.value',
    ];

}