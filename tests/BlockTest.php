<?php

use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Block;

class BlockTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Block::__toString
     * @covers \Ohio\Content\Block::setTemplateAttribute
     * @covers \Ohio\Content\Block::setBodyAttribute
     */
    public function test()
    {
        $block = factory(Block::class)->make();
        $block->name = ' Test ';
        $block->template = ' TEST ';
        $block->body = ' Test ';

        $this->assertEquals($block->name, $block->__toString());
        $this->assertEquals('test', $block->template);
        $this->assertEquals('Test', $block->body);
    }

}