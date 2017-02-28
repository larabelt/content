<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Page;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class PageTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\Page::sections
     */
    public function test()
    {
        $page = factory(Page::class)->make();

        $this->assertInstanceOf(MorphMany::class, $page->sections());
    }

}