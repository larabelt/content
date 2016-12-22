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
     * @covers \Ohio\Content\Handle\Handle::normalizeUrl
     */
    public function test()
    {

        # normalizeUrl
        $this->assertEquals('one', Handle::normalizeUrl('One'));
        $this->assertEquals('one/123/what-just-happened', Handle::normalizeUrl("One/123!!!/What Just Happened?"));

        Page::unguard();
        $page = factory(Page::class)->make();
        $page->id = 1;

        Handle::unguard();
        $handle = factory(Handle::class)->make();
        $handle->handleable_id = 1;
        $handle->handleable_type = $page->getMorphClass();
        $handle->url = ' /Test/test it all ';
        $handle->delta = 1;
        $handle->handleable()->add($page);

        $attributes = $handle->getAttributes();

        # handleable relationship
        //$this->assertInstanceOf(Page::class, $handle->handleable);

        # setters
        $this->assertEquals('test/test-it-all', $handle->__toString());
        $this->assertEquals('test/test-it-all', $attributes['url']);
        $this->assertEquals('pages', $attributes['handleable_type']);
    }

}