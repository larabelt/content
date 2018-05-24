<?php
namespace Belt\Content\Http\Requests;

use Belt;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PaginateTermables
 * @package Belt\Content\Http\Requests
 */
class PaginateTermables extends PaginateTerms
{
    /**
     * @var string
     */
    public $table = 'terms';

    /**
     * @var int
     */
    public $perPage = 10;

    /**
     * @var string
     */
    public $orderBy = 'terms._lft';

    /**
     * @var Belt\Core\Pagination\PaginationQueryModifier[]
     */
    public $queryModifiers = [];

    /**
     * @inheritdoc
     */
    public function modifyQuery(Builder $query)
    {
        # show terms associated with termable
        if (!$this->get('not')) {
            $query->term($this->get('termable_type'), $this->get('termable_id'));
        }

        # show terms not associated with termable
        if ($this->get('not')) {
            $query->notTerm($this->get('termable_type'), $this->get('termable_id'));
        }

        return $query;
    }

}