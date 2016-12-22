<?php

use Ohio\Content\Page\Http\Requests\StorePage;

class StorePageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Page\Http\Requests\StorePage::rules
     */
    public function test()
    {

        $request = new StorePage();

        $this->assertNotEmpty($request->rules());
    }

}