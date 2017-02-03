<?php

use Ohio\Content\Http\Requests\UpdateSection;

class UpdateSectionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Http\Requests\UpdateSection::rules
     */
    public function test()
    {

        $request = new UpdateSection();

        $this->assertNotEmpty($request->rules());
    }

}