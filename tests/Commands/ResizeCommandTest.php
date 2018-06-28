<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Commands\ResizeCommand;
use Belt\Content\Services\ResizeService;
use Illuminate\Filesystem\FilesystemAdapter;

class ResizeCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\ResizeCommand::service
     * @covers \Belt\Content\Commands\ResizeCommand::handle
     */
    public function testHandle()
    {

        $cmd = new ResizeCommand();

        # service
        $this->assertInstanceOf(ResizeService::class, $cmd->service());

        # handle
        $service = m::mock(ResizeService::class);
        $service->shouldReceive('batch')->andReturn(true);

        $cmd = m::mock(ResizeCommand::class . '[service]');
        $cmd->shouldReceive('service')->andReturn($service);

        $cmd->handle();
    }

}