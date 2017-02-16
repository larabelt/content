<?php

use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Behaviors\Handleable;
use Belt\Content\Handle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class HandleableTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::handle
     * @covers \Belt\Content\Behaviors\Handleable::handles
     */
    public function test()
    {
        # handle
        $morphOne = m::mock(Relation::class);
        $morphOne->shouldReceive('where')->withArgs(['delta', 1.00]);
        $pageMock = m::mock(HandleableTestStub::class . '[morphOne]');
        $pageMock->shouldReceive('morphOne')->withArgs([Handle::class, 'handleable'])->andReturn($morphOne);
        $pageMock->shouldReceive('handle');
        $pageMock->handle();

        # handles
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderby')->withArgs(['delta']);
        $pageMock = m::mock(HandleableTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphMany')->withArgs([Handle::class, 'handleable'])->andReturn($morphMany);
        $pageMock->shouldReceive('handles');
        $pageMock->handles();
    }

}

class HandleableTestStub extends Model
{
    use Handleable;
}