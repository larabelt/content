<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Core\Param;
use Belt\Content\Section;
use Belt\Content\Observers\SectionObserver;
use Illuminate\Support\Collection;

class SectionObserverTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Observers\SectionObserver::deleting
     */
    public function test()
    {
        $observer = new SectionObserver();

        $param = m::mock(Param::class);
        $param->shouldReceive('delete')->once();

        $section = new Section();
        $section->params = new Collection([$param]);

        $observer->deleting($section);

    }

}