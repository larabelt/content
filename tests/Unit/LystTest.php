<?php namespace Tests\Belt\Content\Unit;
use Mockery as m;

use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Lyst;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LystTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Lyst::items
     * @covers \Belt\Content\Lyst::toSearchableArray
     */
    public function test()
    {
        $list = new Lyst();

        # listables
        $this->assertInstanceOf(HasMany::class, $list->items());

        # toSearchableArray
        $this->assertNotEmpty($list->toSearchableArray());
    }

}