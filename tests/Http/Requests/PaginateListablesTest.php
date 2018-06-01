<?php
use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Http\Requests\PaginateListables;
use Illuminate\Database\Eloquent\Builder;

class PaginateListablesTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginateListables::modifyQuery
     */
    public function test()
    {
        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->with('listables.list_id', 1);
        $paginateRequest = new PaginateListables(['list_id' => 1]);
        $paginateRequest->modifyQuery($query);
    }

}