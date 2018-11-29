<?php

use Belt\Core\Resources\BaseSubtype;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Resources\Traits\HasListItems;

class ResourceTraitHasListItemTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Resources\Traits\HasListItems::setListItems
     * @covers \Belt\Content\Resources\Traits\HasListItems::getListItems
     */
    public function test()
    {
        $subtype = new StubResourceTraitHasListItemTest();
        $subtype->setListItems(['foo']);
        $this->assertEquals(['foo'], $subtype->getListItems());
    }

}

class StubResourceTraitHasListItemTest extends BaseSubtype
{
    use HasListItems;
}