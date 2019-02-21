<?php namespace Tests\Belt\Content\Unit\Commands;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Services\TranslateStringService;
use Belt\Content\Commands\TranslatableStringCommand;

class TranslatableStringCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\TranslatableStringCommand::service
     * @covers \Belt\Content\Commands\TranslatableStringCommand::handle
     */
    public function testHandle()
    {

        $cmd = new TranslatableStringCommand();

        # service
        $this->assertInstanceOf(TranslateStringService::class, $cmd->service());

        # handle
        $service = m::mock(TranslateStringService::class);
        $service->shouldReceive('buildStorageFile')->with('foo')->andReturnSelf();

        $cmd = m::mock(TranslatableStringCommand::class . '[helper,argument,option]');
        $cmd->shouldReceive('service')->andReturn($service);
        $cmd->shouldReceive('argument')->with('action')->andReturn('build');
        $cmd->shouldReceive('option')->with('locale')->andReturn('foo');

        $cmd->handle();
    }

}