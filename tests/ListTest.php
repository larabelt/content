<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Spot\List;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ListTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Spot\List::places
     * @covers \Belt\Spot\List::listables
     * @covers \Belt\Spot\List::toSearchableArray
     */
    public function test()
    {
        $list = new List();

        # places
        $this->assertInstanceOf(HasMany::class, $list->places());

        # listables
        $this->assertInstanceOf(HasMany::class, $list->listables());

        # toSearchableArray
        $this->assertNotEmpty($list->toSearchableArray());
    }

}