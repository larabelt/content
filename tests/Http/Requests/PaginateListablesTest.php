<?php
use Mockery as m;
use Belt\Core\Testing;
use Belt\Spot\Http\Requests\PaginateListables;
use Illuminate\Database\Eloquent\Builder;

class PaginateListablesTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Spot\Http\Requests\PaginateListables::modifyQuery
     */
    public function test()
    {
        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->with('itinerary_id', 1);
        $paginateRequest = new PaginateListables(['itinerary_id' => 1]);
        $paginateRequest->modifyQuery($query);
    }

}