<?php

use Belt\Content\Http\Requests\StoreSection;

class StoreSectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreSection::rules
     */
    public function test()
    {

        $request = new StoreSection();

        $this->assertNotEmpty($request->rules());
    }

}