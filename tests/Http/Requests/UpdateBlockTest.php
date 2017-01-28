<?php

use Ohio\Content\Http\Requests\UpdateBlock;

class UpdateBlockTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\UpdateBlock::rules
     */
    public function test()
    {

        $request = new UpdateBlock();

        $this->assertNotEmpty($request->rules());
    }

}