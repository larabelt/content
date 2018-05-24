<?php

namespace Belt\Content\Pagination;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Core\Pagination\PaginationQueryModifier;
use Illuminate\Database\Eloquent\Builder;

class TermableQueryModifier extends PaginationQueryModifier
{
    /**
     * Modify the query
     *
     * @param  Builder $qb
     * @param  PaginateRequest $request
     * @return void
     */
    public function modify(Builder $qb, PaginateRequest $request)
    {
        if ($term = $request->get('term')) {
            $qb->hasTerm($term);
        }

        if ($term = $request->get('in_term')) {
            $qb->inTerm($term);
        }
    }
}