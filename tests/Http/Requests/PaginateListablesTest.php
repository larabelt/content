<?php
use Mockery as m;
use Belt\Core\Testing;
use Belt\Spot\Http\Requests\PaginateItineraryPlaces;
use Illuminate\Database\Eloquent\Builder;

class PaginateItineraryPlacesTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Spot\Http\Requests\PaginateItineraryPlaces::modifyQuery
     */
    public function test()
    {
        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->with('itinerary_id', 1);
        $paginateRequest = new PaginateItineraryPlaces(['itinerary_id' => 1]);
        $paginateRequest->modifyQuery($query);
    }

}