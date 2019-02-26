<?php namespace Tests\Belt\Content\Unit\Http\Requests;
use Mockery as m;
use Tests\Belt\Core;
use Belt\Content\Http\Requests\PaginateListItems;
use Illuminate\Database\Eloquent\Builder;

class PaginateListItemsTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginateListItems::modifyQuery
     */
    public function test()
    {
        # list_id
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->with('list_items.list_id', 1);
        $paginateRequest = new PaginateListItems(['list_id' => 1]);
        $paginateRequest->modifyQuery($query);

        # listable_id
        $query = m::mock(Builder::class);
        $query->shouldReceive('whereIn')->once()->with('list_items.listable_id', [1,2]);
        $paginateRequest = new PaginateListItems(['listable_id' => '1,2']);
        $paginateRequest->modifyQuery($query);

        # listable_type
        $query = m::mock(Builder::class);
        $query->shouldReceive('whereIn')->once()->with('list_items.listable_type', ['pages','posts']);
        $paginateRequest = new PaginateListItems(['listable_type' => 'pages,posts']);
        $paginateRequest->modifyQuery($query);

        # groupBy
        $query = m::mock(Builder::class);
        $query->shouldReceive('select')->once()->with(['list_items.listable_type'])->andReturnSelf();
        $query->shouldReceive('groupBy')->once()->with('list_items.listable_type')->andReturnSelf();
        $paginateRequest = new PaginateListItems(['groupBy' => 'listable_type']);
        $paginateRequest->modifyQuery($query);
    }

}