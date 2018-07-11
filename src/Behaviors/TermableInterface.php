<?php

namespace Belt\Content\Behaviors;

interface TermableInterface
{

    /**
     * @return mixed
     */
    function terms();

    /**
     * Model requires \Belt\Core\Behaviors\HasSortableTrait
     *
     * @param $related
     * @param $name
     * @param string $orderColumn
     * @param null $table
     * @param null $foreignPivotKey
     * @param null $relatedPivotKey
     * @param null $parentKey
     * @param null $relatedKey
     * @param bool $inverse
     * @return mixed
     */
    public function morphToSortedMany(
        $related,
        $name,
        $orderColumn = 'position',
        $table = null,
        $foreignPivotKey = null,
        $relatedPivotKey = null,
        $parentKey = null,
        $relatedKey = null,
        $inverse = false
    );

}