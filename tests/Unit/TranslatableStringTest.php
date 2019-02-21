<?php namespace Tests\Belt\Content\Unit;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\TranslatableString;

class TranslatableStringTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\TranslatableString::getTranslatableAttributes
     */
    public function test()
    {
        $translatableString = factory(TranslatableString::class)->make();

        # getTranslatableAttributes
        $this->assertEquals(['value'], $translatableString->getTranslatableAttributes());
    }

}