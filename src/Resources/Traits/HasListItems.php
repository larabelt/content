<?php

namespace Belt\Content\Resources\Traits;

/**
 * Trait HasListItems
 * @package Belt\Core\Resources\Traits
 */
trait HasListItems
{
    /**
     * @var string
     */
    protected $listItems;

    /**
     * @param $listItems
     * @return $this
     */
    public function setListItems($listItems)
    {
        $this->listItems = $listItems;

        return $this;
    }

    /**
     * @return string
     */
    public function getListItems()
    {
        return $this->listItems;
    }

}