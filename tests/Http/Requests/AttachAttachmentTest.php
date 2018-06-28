<?php

use Belt\Content\Http\Requests\AttachAttachment;

class AttachAttachmentTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\AttachAttachment::rules
     */
    public function test()
    {

        $request = new AttachAttachment();

        $this->assertNotEmpty($request->rules());
    }

}