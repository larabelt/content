<?php namespace Tests\Belt\Content\Unit\Resources\Subtypes;

use Tests\Belt\Core\BeltTestCase;
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