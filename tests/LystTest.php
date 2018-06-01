<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Lyst;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LystTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Lyst::places
     * @covers \Belt\Content\Lyst::listables
     * @covers \Belt\Content\Lyst::toSearchableArray
     */
    public function test()
    {
        $list = new Lyst();

        # places
        $this->assertInstanceOf(HasMany::class, $list->places());

        # listables
        $this->assertInstanceOf(HasMany::class, $list->listables());

        # toSearchableArray
        $this->assertNotEmpty($list->toSearchableArray());
    }

}