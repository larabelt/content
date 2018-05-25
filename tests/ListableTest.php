<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Listable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListableTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Listable::place
     */
    public function test()
    {
        $listable = new Listable();

        # place
        $this->assertInstanceOf(BelongsTo::class, $listable->place());
    }

}