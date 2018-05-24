<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Section;
use Belt\Content\Term;
use Belt\Content\Jobs\UpdateTermData;
use Belt\Content\Observers\TermObserver;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class TermObserverTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Observers\TermObserver::deleting
     * @covers \Belt\Content\Observers\TermObserver::saving
     * @covers \Belt\Content\Observers\TermObserver::saved
     * @covers \Belt\Content\Observers\TermObserver::readyDispatch
     * @covers \Belt\Content\Observers\TermObserver::dispatch
     */
    public function test()
    {
        Term::unguard();
        $observer = new TermObserver();

        # deleting
        $section = m::mock(Section::class);
        $section->shouldReceive('delete')->once();
        $term = m::mock(Term::class . '[attachments]');
        $term->shouldReceive('attachments')->once()->andReturnSelf();
        $term->shouldReceive('detach')->once()->andReturnSelf();
        $term->id = 1;
        $term->sections = new Collection([$section]);
        DB::shouldReceive('table')->once()->andReturnSelf();
        DB::shouldReceive('where')->once()->with('term_id', 1)->andReturnSelf();
        DB::shouldReceive('delete')->once();
        $observer->deleting($term);

        # saving, saved, readyDispatch, dispatch
        Queue::fake();
        $term = m::mock(Term::class);
        $term->shouldReceive('getDirty')->andReturn(['name' => 'new name']);
        $observer = new TermObserver();
        $observer->saving($term);
        $observer->saved($term);
        Queue::assertPushed(UpdateTermData::class, function ($job) use ($term) {
            return $job->term === $term;
        });

    }

}