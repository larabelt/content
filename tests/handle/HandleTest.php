<?php

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Page\Page;
use Ohio\Content\Handle\Handle;

class HandleTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Handle\Handle::__toString
     * @covers \Ohio\Content\Handle\Handle::setUrlAttribute
     * @covers \Ohio\Content\Handle\Handle::handleable
     */
    public function test()
    {

        $page = factory(Page::class)->make();
        $handle = factory(Handle::class)->make();

        Handle::unguard();

        $handle->handleable_id = 1;
        $handle->handleable_type = $page->getMorphClass();
        $handle->url = ' Test ';
        $handle->delta = 1;

        $attributes = $handle->getAttributes();

        # handleable relationship
        $this->assertInstanceOf(Page::class, $handle->handleable);

        # setters
        $this->assertEquals('test', $handle->__toString());
        $this->assertEquals('test', $attributes['url']);
        $this->assertEquals('content/page', $attributes['handleable_type']);
    }

}