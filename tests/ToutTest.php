<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Tout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToutTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Tout::image
     */
    public function test()
    {
        $tout = factory(Tout::class)->make();

        # image
        $this->assertInstanceOf(BelongsTo::class, $tout->image());
    }

}