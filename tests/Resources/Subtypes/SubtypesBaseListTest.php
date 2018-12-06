<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Resources\Subtypes\BaseList;

class SubtypesBaseListTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Resources\Subtypes\BaseList::toArray
     */
    public function test()
    {
        $subtype = new BaseList();
        $subtype->setLabel('foo');
        $this->assertEquals('foo', array_get($subtype->toArray(), 'label'));
    }

}