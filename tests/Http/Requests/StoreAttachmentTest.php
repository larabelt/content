<?php

use Belt\Core\Testing;
use Belt\Content\Http\Requests\StoreAttachment;

class StoreAttachmentTest extends Testing\BeltTestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\StoreAttachment::rules
     */
    public function test()
    {

        $request = new StoreAttachment();

        $this->assertNotEmpty($request->rules());
    }

}