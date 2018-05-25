<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Illuminate\Database\Eloquent\Builder;
use Belt\Core\Http\Requests\PaginateRequest;

/**
 * Class PaginateListables
 * @package Belt\Place\Http\Requests
 */
class PaginateListables extends PaginateRequest
{

    /**
     * @var int
     */
    public $perPage = 100;

    /**
     * @var string
     */
    public $orderBy = 'listable.position';

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [];

    /**
     * @inheritdoc
     */
    public function modifyQuery(Builder $query)
    {
        if ($list_id = $this->get('list_id')) {
            $query->where('list_id', $list_id);
        }

        return $query;
    }

}