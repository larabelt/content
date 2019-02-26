<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Tests\Belt\Core;
use Belt\Content\Http\Requests\StoreAttachment;

class StoreAttachmentTest extends \Tests\Belt\Core\BeltTestCase
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