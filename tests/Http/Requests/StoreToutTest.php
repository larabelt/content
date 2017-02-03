<?php

use Ohio\Content\Http\Requests\StoreTout;

class StoreToutTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\StoreTout::rules
     */
    public function test()
    {

        $request = new StoreTout();

        $this->assertNotEmpty($request->rules());
    }

}