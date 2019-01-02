<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Handle;
use Belt\Content\Observers\HandleObserver;
use Illuminate\Support\Facades\DB;

class HandleObserverTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Observers\HandleObserver::saving
     * @covers \Belt\Content\Observers\HandleObserver::saved
     */
    public function test()
    {
        $this->enableI18n();

        Handle::unguard();
        $observer = new HandleObserver();

        # saving
        $handle = new Handle(['is_active' => false, 'is_default' => true]);
        $observer->saving($handle);
        $this->assertTrue($handle->is_active);

        $handle = new Handle(['subtype' => 'alias', 'target' => 'foo']);
        $observer->saving($handle);
        $this->assertNull($handle->target);

        # saved
        $handle = new Handle([
            'handleable_type' => 'foo',
            'handleable_id' => 1,
            'is_default' => true,
            'subtype' => 'alias',
        ]);
        $observer->saved($handle);
        $qb = m::mock(\Illuminate\Database\Eloquent\Builder::class);
        $qb->shouldReceive('where')->with('handleable_type', 'foo')->andReturnSelf();
        $qb->shouldReceive('where')->with('handleable_id', 1)->andReturnSelf();
        $qb->shouldReceive('where')->with('id', '!=', 1)->andReturnSelf();
        $qb->shouldReceive('update')->with(['is_default' => false])->andReturnSelf();
        DB::shouldReceive('table')->with('handles')->andReturn($qb);
    }

}