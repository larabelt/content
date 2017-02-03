<?php

use Mockery as m;
use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Commands\CompileCommand;
use Ohio\Content\Services\CompileService;

class CompileCommandTest extends OhioTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Commands\CompileCommand::service
     * @covers \Ohio\Content\Commands\CompileCommand::handle
     */
    public function testHandle()
    {

        $cmd = new CompileCommand();

        # service
        $this->assertInstanceOf(CompileService::class, $cmd->service());

        # handle
        $service = m::mock(CompileService::class);
        $service->shouldReceive('pages')->andReturn(true);

        $cmd = m::mock(CompileCommand::class . '[service]');
        $cmd->shouldReceive('service')->andReturn($service);

        $cmd->handle();
    }

}