<?php namespace Tests\Belt\Content\Unit\Jobs;

use Mockery as m;
use Belt\Content\Jobs\MoveAttachment;
use Tests\Belt\Core;
use Belt\Content\Attachment;
use Belt\Content\Services\MoveService;

class MoveAttachmentTest extends \Tests\Belt\Core\BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Jobs\MoveAttachment::__construct
     * @covers \Belt\Content\Jobs\MoveAttachment::service
     * @covers \Belt\Content\Jobs\MoveAttachment::handle
     */
    public function test()
    {
        $attachment = factory(Attachment::class)->make();
        $target = 'foo';
        $options = ['foo' => 'bar'];
        $job = new MoveAttachment($attachment, $target, $options);

        # service
        $this->assertInstanceOf(MoveService::class, $job->service());

        # handle
        $service = m::mock(MoveService::class . '[move]');
        $service->shouldReceive('move')->with($attachment, $target, $options)->andReturnSelf();
        $job->service = $service;
        $job->handle();
    }

}