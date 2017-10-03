<?php

namespace Belt\Content\Search\Elastic\Pagination;

use Belt\Core\Http\Requests\PaginateRequest;

/**
 * Class PaginationQueryModifier
 * @package Belt\Content\Elastic\Pagination
 */
abstract class PaginationQueryModifier
{
    /**
     * Modify query
     *
     * @param array $query
     * @param PaginateRequest $request
     * @return mixed
     */
    abstract public function modify(array $query, PaginateRequest $request);

}