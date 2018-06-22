<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Illuminate\Database\Eloquent\Builder;
use Belt\Core\Http\Requests\PaginateRequest;

/**
 * Class PaginateListItems
 * @package Belt\Place\Http\Requests
 */
class PaginateListItems extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\ListItem::class;

    /**
     * @var int
     */
    public $perPage = 100;

    /**
     * @var string
     */
    public $orderBy = 'list_items.position';

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
            $query->where('list_items.list_id', $list_id);
        }

        if ($id = $this->get('listable_id')) {
            $query->whereIn('list_items.listable_id', explode(',', $id));
        }

        if ($type = $this->get('listable_type')) {
            $query->whereIn('list_items.listable_type', explode(',', $type));
        }

        if ($groupBy = $this->get('groupBy')) {
            if ($groupBy == 'listable_type') {
                $query->select(['list_items.listable_type']);
                $query->groupBy('list_items.listable_type');
                $this->orderBy = 'list_items.listable_type';
            }
        }

        return $query;
    }

}