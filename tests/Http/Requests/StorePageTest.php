<?php

use Ohio\Content\Http\Requests\StorePage;

class StorePageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\StorePage::rules
     */
    public function test()
    {

        $request = new StorePage();

        $this->assertNotEmpty($request->rules());
    }

}