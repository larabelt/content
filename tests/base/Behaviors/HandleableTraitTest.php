<?php

use Mockery as m;

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Base\Behaviors\HandleableTrait;
use Ohio\Content\Handle\Handle;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class HandleableTraitTest extends OhioTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Base\Behaviors\HandleableTrait::handle
     * @covers \Ohio\Content\Base\Behaviors\HandleableTrait::handles
     */
    public function test()
    {
        # handle
        $morphOne = m::mock(Relation::class);
        $morphOne->shouldReceive('where')->withArgs(['delta', 1.00]);
        $pageMock = m::mock(HandleableTraitTestStub::class . '[morphOne]');
        $pageMock->shouldReceive('morphOne')->withArgs([Handle::class, 'handleable'])->andReturn($morphOne);
        $pageMock->shouldReceive('handle');
        $pageMock->handle();

        # handles
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderby')->withArgs(['delta']);
        $pageMock = m::mock(HandleableTraitTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphMany')->withArgs([Handle::class, 'handleable'])->andReturn($morphMany);
        $pageMock->shouldReceive('handles');
        $pageMock->handles();
    }

}

class HandleableTraitTestStub extends Model
{
    use HandleableTrait;
}