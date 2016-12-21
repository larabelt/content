<?php

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Tag\Tag;

class TagTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Tag\Tag::__toString
     * @covers \Ohio\Content\Tag\Tag::setTemplateAttribute
     * @covers \Ohio\Content\Tag\Tag::setBodyAttribute
     */
    public function test()
    {
        $tag = factory(Tag::class)->make();
        $tag->name = ' Test ';
        $tag->template = ' TEST ';
        $tag->body = ' Test ';

        $this->assertEquals($tag->name, $tag->__toString());
        $this->assertEquals('test', $tag->template);
        $this->assertEquals('Test', $tag->body);
    }

}