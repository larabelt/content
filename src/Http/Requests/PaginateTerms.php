<?php

namespace Belt\Content\Http\Requests;

use Belt;
use Belt\Core\Http\Requests\PaginateRequest;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PaginateTerms
 * @package Belt\Content\Http\Requests
 */
class PaginateTerms extends PaginateRequest
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $modelClass = Belt\Content\Term::class;

    /**
     * @var int
     */
    public $perPage = 10;

    /**
     * @var string
     */
    public $orderBy = 'terms._lft';

    /**
     * @var array
     */
    public $sortable = [
        'terms.id',
        'terms.name',
        'terms.created_at',
        'terms.updated_at',
    ];

    /**
     * @var array
     */
    public $searchable = [
        'terms.name',
        'terms.names',
    ];

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [
        Belt\Core\Pagination\InQueryModifier::class,
        Belt\Core\Pagination\IsActiveQueryModifier::class,
        Belt\Core\Pagination\SubtypeQueryModifier::class,
    ];

    /**
     * @inheritdoc
     */
    public function modifyQuery(Builder $query)
    {
        # show child terms
        if ($parent_ids = $this->get('parent_id')) {
            $query->whereIn('terms.parent_id', explode(',', $parent_ids));
        }

        return $query;
    }

}