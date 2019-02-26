<?php namespace Tests\Belt\Content\Unit\Commands;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Commands\MoveCommand;
use Belt\Content\Services\MoveService;

class MoveCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\MoveCommand::service
     * @covers \Belt\Content\Commands\MoveCommand::handle
     */
    public function testHandle()
    {

        $cmd = new MoveCommand();

        # service
        $this->assertInstanceOf(MoveService::class, $cmd->service());

        # handle
        $arguments = [
            'source' => 'path/to/source',
            'target' => 'path/to/target',
        ];
        $options = [
            'ids' => '1,2,3',
            'limit' => '100',
            'path' => '',
            'queue' => null,
        ];

        $service = m::mock(MoveService::class);
        $service->shouldReceive('run')->with($arguments['source'], $arguments['target'], $options)->andReturn(true);
        $service->shouldReceive('destroyTmpFile')->andReturnSelf();

        $cmd = m::mock(MoveCommand::class . '[service,argument,option]');
        $cmd->shouldReceive('service')->andReturn($service);
        $cmd->shouldReceive('argument')->with('source')->andReturn($arguments['source']);
        $cmd->shouldReceive('argument')->with('target')->andReturn($arguments['target']);
        $cmd->shouldReceive('option')->with('ids')->andReturn($options['ids']);
        $cmd->shouldReceive('option')->with('limit')->andReturn($options['limit']);
        $cmd->shouldReceive('option')->with('path')->andReturn($options['path']);
        $cmd->shouldReceive('option')->with('queue')->andReturn($options['queue']);

        $cmd->handle();
    }

}