<?php

namespace Belt\Content\Behaviors;

/**
 * Interface ClippableInterface
 * @package Belt\Content\Behaviors
 */
interface ClippableInterface
{

    /**
     * @return mixed
     */
    public function getResizePresets();

    /**
     * @return mixed
     */
    public function attachments();

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

    /**
     * Model requires \Belt\Content\Behaviors\IncludesTemplate
     *
     * @param null $key
     * @param null $default
     * @return mixed
     * @throws \Exception
     */
    public function getTemplateConfig($key = null, $default = null);

}