<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Resources\Subtypes\BasePage;

class SubtypesBasePageTest extends BeltTestCase
{

    /**
     * @covers \Belt\Content\Resources\Subtypes\BasePage::toArray
     */
    public function test()
    {
        $subtype = new BasePage();
        $subtype->setLabel('foo');
        $this->assertEquals('foo', array_get($subtype->toArray(), 'label'));
    }

}