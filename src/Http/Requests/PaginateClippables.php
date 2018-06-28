<?php
namespace Belt\Content\Http\Requests;

use Belt;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PaginateClippables
 * @package Belt\Content\Http\Requests
 */
class PaginateClippables extends PaginateAttachments
{
    /**
     * @var int
     */
    public $perPage = 20;

    /**
     * @var string
     */
    public $orderBy = 'clippables.position';

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [];

    /**
     * @inheritdoc
     */
    public function modifyQuery(Builder $query)
    {
        # show files associated with clippable
        if (!$this->get('not')) {
            $query->attached($this->get('clippable_type'), $this->get('clippable_id'));
        }

        # show files not associated with clippable
        if ($this->get('not')) {
            $query->notAttached($this->get('clippable_type'), $this->get('clippable_id'));
        }

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function items(Builder $query)
    {
        return $query->get();
    }

}