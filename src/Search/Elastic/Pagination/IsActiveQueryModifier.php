<?php

namespace Belt\Content\Search\Elastic\Pagination;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Content\Search\Elastic\Pagination\PaginationQueryModifier;

class IsActiveQueryModifier extends PaginationQueryModifier
{
    /**
     * Modify the query
     *
     * @param  array $query
     * @param  PaginateRequest $request
     * @return $query
     */
    public function modify(array $query, PaginateRequest $request)
    {
        if ($request->query->has('is_active')) {
            $is_active = $request->query->get('is_active') ? true : false;
            $query['bool']['must'][]['terms'] = [
                'is_active' => [$is_active],
            ];
        }

        return $query;
    }
}