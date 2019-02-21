<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\UpdateSection;

class UpdateSectionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateSection::rules
     */
    public function test()
    {

        $request = new UpdateSection();

        //$this->assertNotEmpty($request->rules());
        $this->assertEmpty($request->rules());
    }

}