<?php

use Ohio\Content\Block\Http\Requests\UpdateBlock;

class UpdateBlockTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Block\Http\Requests\UpdateBlock::rules
     */
    public function test()
    {

        $request = new UpdateBlock();

        $this->assertNotEmpty($request->rules());
    }

}