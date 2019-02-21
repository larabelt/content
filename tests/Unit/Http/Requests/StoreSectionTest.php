<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\StoreSection;

class StoreSectionTest extends \PHPUnit\Framework\TestCase
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