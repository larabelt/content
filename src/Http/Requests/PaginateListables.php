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
    public $orderBy = 'listables.position';

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
            $query->where('listables.list_id', $list_id);
        }

        if ($id = $this->get('listable_id')) {
            $query->whereIn('listables.listable_id', explode(',', $id));
        }

        if ($type = $this->get('listable_type')) {
            $query->whereIn('listables.listable_type', explode(',', $type));
        }

        if ($groupBy = $this->get('groupBy')) {
            if ($groupBy == 'listable_type') {
                $query->select(['listables.listable_type']);
                $query->groupBy('listables.listable_type');
                $this->orderBy = 'listables.listable_type';
            }
        }

        return $query;
    }

}