<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Term;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TermTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Term::scopeTerm
     * @covers \Belt\Content\Term::scopeNotTerm
     * @covers \Belt\Content\Term::getHierarchyAttribute
     * @covers \Belt\Content\Term::getFullNameAttribute
     * @covers \Belt\Content\Term::getDefaultUrlAttribute
     * @covers \Belt\Content\Term::getUrlAttribute
     */
    public function test()
    {
        $term = factory(Term::class)->make();

        # getFullNameAttribute
        $this->assertEquals($term->getNestedName(), $term->full_name);

        # getDefaultUrlAttribute
        $this->assertNotEmpty($term->default_url);
        $this->assertEquals($term->default_url, $term->url);

        # scopeTerm
        $qbMock = m::mock(Builder::class);
        $qbMock->shouldReceive('select')->once()->with(['terms.*']);
        $qbMock->shouldReceive('join')->once()->with('termables', 'termables.term_id', '=', 'terms.id');
        $qbMock->shouldReceive('where')->once()->with('termables.termable_type', 'pages');
        $qbMock->shouldReceive('where')->once()->with('termables.termable_id', 1);
        $qbMock->shouldReceive('orderBy')->once()->with('termables.position');
        $term->scopeTerm($qbMock, 'pages', 1);

        # scopeNotTerm
        $qbMock = m::mock(Builder::class);
        $qbMock->shouldReceive('select')->once()->with(['terms.*']);
        $qbMock->shouldReceive('leftJoin')->once()->with('termables',
            m::on(function (\Closure $closure) {
                $subQBMock = m::mock(Builder::class);
                $subQBMock->shouldReceive('on')->once()->with('termables.term_id', '=', 'terms.id');
                $subQBMock->shouldReceive('where')->once()->with('termables.termable_type', 'pages');
                $subQBMock->shouldReceive('where')->once()->with('termables.termable_id', 1);
                $closure($subQBMock);
                return is_callable($closure);
            })
        );
        $qbMock->shouldReceive('whereNull')->once()->with('termables.id');
        $term->scopeNotTerm($qbMock, 'pages', 1);

        # getHierarchyAttribute
        Term::unguard();
        $ancestors = new \Illuminate\Database\Eloquent\Collection();
        $ancestors->push(new Term([
            'id' => 1,
            'name' => 'One',
            'slug' => 'one',
        ]));
        $ancestors->push(new Term([
            'id' => 2,
            'name' => 'Two',
            'slug' => 'two',
        ]));
        $ancestors->push(new Term([
            'id' => 3,
            'name' => 'Three',
            'slug' => 'three',
        ]));
        $term = m::mock(Term::class . '[ancestors]');
        $term->shouldReceive('ancestors')->andReturnSelf();
        $term->shouldReceive('get')->andReturn($ancestors);
        $term->id = 4;
        $term->name = 'Four';
        $term->slug = 'four';
        $hierarchy = $term->getHierarchyAttribute();
        $this->assertEquals(4, count($hierarchy));
        $this->assertEquals('four', array_get($hierarchy, '3.slug'));

    }

}