<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Commands\CompileCommand;
use Belt\Content\Services\CompileService;

class CompileCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\CompileCommand::service
     * @covers \Belt\Content\Commands\CompileCommand::handle
     */
    public function testHandle()
    {

        $cmd = new CompileCommand();

        # service
        $this->assertInstanceOf(CompileService::class, $cmd->service());

        # handle
        $cmd->handle();
    }

}