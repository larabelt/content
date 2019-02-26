<?php namespace Tests\Belt\Content\Unit\Commands;

use Mockery as m;
use Tests\Belt\Core\BeltTestCase;
use Belt\Core\Helpers\MorphHelper;
use Belt\Core\Behaviors\IncludesSubtypesInterface;
use Belt\Core\Behaviors\IncludesSubtypes;
use Belt\Content\Commands\SubtypeCommand;
use Illuminate\Database\Eloquent\Model;

class SubtypeCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\SubtypeCommand::helper
     * @covers \Belt\Content\Commands\SubtypeCommand::handle
     */
    public function testHandle()
    {

        $cmd = new SubtypeCommand();

        # helper
        $this->assertInstanceOf(MorphHelper::class, $cmd->helper());

        # handle
        $helper = m::mock(MorphHelper::class);
        $helper->shouldReceive('type2Class')->andReturn(SubtypeCommandTestStub::class);

        $cmd = m::mock(SubtypeCommand::class . '[helper,argument,option]');
        $cmd->shouldReceive('helper')->andReturn($helper);
        $cmd->shouldReceive('argument')->andReturn('reconcile-params');
        $cmd->shouldReceive('option')->andReturn('test');

        $cmd->handle();
    }

}

class SubtypeCommandTestStub extends Model implements IncludesSubtypesInterface
{
    use IncludesSubtypes;

    public static function all($columns = ['*'])
    {
        $item = m::mock(Model::class);
        $item->shouldReceive('touch')->andReturnSelf();

        return [$item];
    }

    public function getMorphClass()
    {
        return 'pages';
    }
}