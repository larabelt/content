<?php

use Ohio\Content\Http\Requests\UpdateTout;

class UpdateToutTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\UpdateTout::rules
     */
    public function test()
    {

        $request = new UpdateTout();

        $this->assertNotEmpty($request->rules());
    }

}