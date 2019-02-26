<?php namespace Tests\Belt\Content\Unit\Commands;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Content\Commands\FakerCommand;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
use Faker\Generator;

class FakerCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\FakerCommand::disk
     * @covers \Belt\Content\Commands\FakerCommand::faker
     * @covers \Belt\Content\Commands\FakerCommand::handle
     */
    public function testHandle()
    {

        $cmd = new FakerCommand();

        # disk
        $this->assertInstanceOf(Filesystem::class, $cmd->disk());

        # faker
        $this->assertInstanceOf(Generator::class, $cmd->faker());

        # handle
        $disk = m::mock(FilesystemAdapter::class);
        $disk->shouldReceive('putFileAs')->times(3)->andReturn(true);

        $cmd = m::mock(FakerCommand::class . '[disk, option, info]');
        $cmd->shouldReceive('disk')->andReturn($disk);
        $cmd->shouldReceive('option')->with('limit')->andReturn(3);
        $cmd->shouldReceive('option')->with('category')->andReturn(null);
        $cmd->shouldReceive('info')->andReturn(null);

        $cmd->handle();
    }

}