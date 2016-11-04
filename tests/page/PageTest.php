<?php

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Page\Page;

class PageTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Page\Page::__toString
     * @covers \Ohio\Content\Page\Page::setIsActiveAttribute
     * @covers \Ohio\Content\Page\Page::setTemplateAttribute
     * @covers \Ohio\Content\Page\Page::setIntroAttribute
     * @covers \Ohio\Content\Page\Page::setBodyAttribute
     * @covers \Ohio\Content\Page\Page::setExtraAttribute
     */
    public function test()
    {
        $page = factory(Page::class)->make();
        $page->is_active = 1;
        $page->name = ' Test ';
        $page->template = ' TEST ';
        $page->intro = ' Test ';
        $page->body = ' Test ';
        $page->extra = ' Test ';



        $this->assertTrue($page->is_active);
        $this->assertEquals($page->name, $page->__toString());
        $this->assertEquals('test', $page->template);
        $this->assertEquals('Test', $page->intro);
        $this->assertEquals('Test', $page->body);
        $this->assertEquals('Test', $page->extra);
    }

}