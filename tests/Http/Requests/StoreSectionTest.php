<?php

use Ohio\Content\Http\Requests\StoreSection;

class StoreSectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\StoreSection::rules
     */
    public function test()
    {

        $request = new StoreSection();

        $this->assertNotEmpty($request->rules());
    }

}