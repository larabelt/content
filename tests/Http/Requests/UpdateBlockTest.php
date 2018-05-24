<?php

use Belt\Content\Http\Requests\UpdateBlock;

class UpdateBlockTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateBlock::rules
     */
    public function test()
    {

        $request = new UpdateBlock();

        $this->assertNotEmpty($request->rules());
    }

}