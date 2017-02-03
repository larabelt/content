<?php

use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Page;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Page::sections
     */
    public function test()
    {
        $page = factory(Page::class)->make();

        $this->assertInstanceOf(HasMany::class, $page->sections());
    }

}