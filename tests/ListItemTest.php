<?php
use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\ListItem;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ListItemTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\ListItem::listable
     */
    public function test()
    {
        $listable = new ListItem();

        # place
        $this->assertInstanceOf(MorphTo::class, $listable->listable());
    }

}