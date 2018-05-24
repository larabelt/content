<?php

use Mockery as m;
use Belt\Core\Testing;

use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Content\Pagination\TermableQueryModifier;
use Illuminate\Database\Eloquent\Builder;

class TermableQueryModifierTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Pagination\TermableQueryModifier::modify
     */
    public function test()
    {
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('hasTerm')->once()->with(1);
        $qb->shouldReceive('inTerm')->once()->with(2);

        $request = new PaginateRequest(['term' => '1', 'in_term' => 2]);

        $modifer = new TermableQueryModifier($qb, $request);
        $modifer->modify($qb, $request);
    }

}