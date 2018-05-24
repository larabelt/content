<?php

use Belt\Content\Http\Requests\UpdatePage;

class UpdatePageTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdatePage::rules
     */
    public function test()
    {

        $request = new UpdatePage();

        $this->assertNotEmpty($request->rules());
    }

}