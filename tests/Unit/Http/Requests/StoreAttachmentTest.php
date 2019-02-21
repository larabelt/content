<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Core\Tests;
use Belt\Content\Http\Requests\StoreAttachment;

class StoreAttachmentTest extends Tests\BeltTestCase
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