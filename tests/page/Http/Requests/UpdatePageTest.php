<?php

use Ohio\Content\Page\Http\Requests\UpdatePage;

class UpdatePageTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Page\Http\Requests\UpdatePage::rules
     */
    public function test()
    {

        $request = new UpdatePage();

        $this->assertNotEmpty($request->rules());
    }

}