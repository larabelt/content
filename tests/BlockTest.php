<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Block;

class BlockTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\Block::__toString
     * @covers \Belt\Content\Block::setTemplateAttribute
     * @covers \Belt\Content\Block::setBodyAttribute
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