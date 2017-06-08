<?php

use Belt\Content\Http\Requests\StorePage;

class StorePageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StorePage::rules
     */
    public function test()
    {

        $request = new StorePage();
        $this->assertNotEmpty($request->rules());

        $request = new StorePage(['source' => 1]);
        $this->assertArrayHasKey('source', $request->rules());
    }

}