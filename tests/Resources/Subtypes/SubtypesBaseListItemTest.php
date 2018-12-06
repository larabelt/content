<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Resources\Subtypes\BaseListItem;

class SubtypesBaseListItemTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Resources\Subtypes\BaseListItem::toArray
     */
    public function test()
    {
        $subtype = new BaseListItem();
        $subtype->setLabel('foo');
        $this->assertEquals('foo', array_get($subtype->toArray(), 'label'));
    }

}