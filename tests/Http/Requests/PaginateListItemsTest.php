<?php
use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Http\Requests\PaginateListItems;
use Illuminate\Database\Eloquent\Builder;

class PaginateListItemsTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginateListItems::modifyQuery
     */
    public function test()
    {
        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->with('listables.list_id', 1);
        $paginateRequest = new PaginateListItems(['list_id' => 1]);
        $paginateRequest->modifyQuery($query);
    }

}