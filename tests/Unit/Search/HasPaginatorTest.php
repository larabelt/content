<?php namespace Tests\Belt\Content\Unit\Search;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Search\HasPaginator;
use Belt\Content\Search\Local\LocalSearchPaginator;

class HasPaginatorTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Search\HasPaginator::getPaginatorClass
     */
    public function test()
    {
        $engine = new HasPaginatorStub();
        $this->assertEquals(LocalSearchPaginator::class, $engine->getPaginatorClass());
    }

}

class HasPaginatorStub
{
    use HasPaginator;

    public static $paginatorClass = LocalSearchPaginator::class;
}