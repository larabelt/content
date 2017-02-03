<?php
use Mockery as m;

use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Tout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ToutTest extends OhioTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Tout::image
     */
    public function test()
    {
        $tout = factory(Tout::class)->make();

        # image
        $this->assertInstanceOf(BelongsTo::class, $tout->image());
    }

}