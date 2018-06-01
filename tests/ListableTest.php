<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Listable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ListableTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Listable::listable
     */
    public function test()
    {
        $listable = new Listable();

        # place
        $this->assertInstanceOf(MorphTo::class, $listable->listable());
    }

}