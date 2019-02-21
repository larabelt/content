<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Belt\Content\Http\Requests\UpdateAttachment;

class UpdateAttachmentTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Http\Requests\UpdateAttachment::rules
     */
    public function test()
    {

        $request = new UpdateAttachment();

        $this->assertNotEmpty($request->rules());
    }

}