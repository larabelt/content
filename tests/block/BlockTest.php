<?php

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Block\Block;

class BlockTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Block\Block::__toString
     * @covers \Ohio\Content\Block\Block::setTemplateAttribute
     * @covers \Ohio\Content\Block\Block::setBodyAttribute
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