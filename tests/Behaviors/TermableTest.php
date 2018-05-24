<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Behaviors\Termable;
use Belt\Content\Term;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class TermableTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Behaviors\Termable::terms
     * @covers \Belt\Content\Behaviors\Termable::termQB
     * @covers \Belt\Content\Behaviors\Termable::purgeTerms
     * @covers \Belt\Content\Behaviors\Termable::scopeHasTerm
     * @covers \Belt\Content\Behaviors\Termable::scopeInTerm
     */
    public function test()
    {
        # terms
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderby')->withArgs(['delta']);
        $pageMock = m::mock(TermableTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphToSortedMany')->withArgs([Term::class, 'termable'])->andReturn($morphMany);
        $pageMock->shouldReceive('terms');
        $pageMock->terms();

        # purgeTerms
        $termable = new TermableTestStub();
        $termable->id = 1;
        DB::shouldReceive('connection')->once()->andReturnSelf();
        DB::shouldReceive('table')->once()->with('termables')->andReturnSelf();
        DB::shouldReceive('where')->once()->with('termable_id', 1)->andReturnSelf();
        DB::shouldReceive('where')->once()->with('termable_type', 'termableTestStub')->andReturnSelf();
        DB::shouldReceive('delete')->once()->andReturnSelf();
        $termable->purgeTerms();

        # scopeHasTerm
        $termable = new TermableTestStub();
        $qbMock = m::mock(Builder::class);
        $qbMock->shouldReceive('whereHas')->twice()->with('terms',
            m::on(function (\Closure $closure) {
                $qbMock = m::mock(Builder::class);
                $qbMock->shouldReceive('where')->with('terms.id', 1);
                $qbMock->shouldReceive('where')->with('terms.slug', 'test');
                $closure($qbMock);
                return is_callable($closure);
            })
        );
        $termable->scopeHasTerm($qbMock, 1);
        $termable->scopeHasTerm($qbMock, 'test');

        # scopeInTerm
        $termable = new TermableTestStub();
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('whereHas')->twice()->with('terms',
            m::on(function (\Closure $closure) {
                $qb = m::mock(Builder::class);
                $qb->shouldReceive('where')->with(
                    m::on(function (\Closure $closure) {
                        $sub = m::mock(Builder::class);
                        $sub->shouldReceive('where')->with('terms._lft', '>=', 10)->andReturnSelf();
                        $sub->shouldReceive('where')->with('terms._rgt', '<=', 20)->andReturnSelf();
                        $closure($sub);
                        return is_callable($closure);
                    })
                );
                $closure($qb);
                return is_callable($closure);
            })
        );
        $termable->scopeInTerm($qb, 1);
        $termable->scopeInTerm($qb, 'test');

        # termQB
        $termable = new TermableTestStub2();
        $this->assertInstanceOf(Builder::class, $termable->termQB());
    }

}

class TermableTestStub extends Model
{
    use Termable;

    public function getMorphClass()
    {
        return 'termableTestStub';
    }

    public function termQB()
    {
        Term::unguard();

        $qb = m::mock(Builder::class);
        $qb->shouldReceive('sluggish')->with(1)->andReturnSelf();
        $qb->shouldReceive('sluggish')->with('test')->andReturnSelf();
        $qb->shouldReceive('first')->andReturn(
            new Term([
                '_lft' => 10,
                '_rgt' => 20,
            ])
        );

        return $qb;
    }
}

class TermableTestStub2 extends Model
{
    use Termable;
}