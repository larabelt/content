<?php

use Belt\Content\Http\Requests\UpdateClippable;

class UpdateClippableTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateClippable::rules
     */
    public function test()
    {

        $request = new UpdateClippable();

        $this->assertNotEmpty($request->rules());
    }

}