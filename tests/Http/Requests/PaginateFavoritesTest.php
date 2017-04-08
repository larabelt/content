<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Http\Requests\PaginateFavorites;
use Illuminate\Database\Eloquent\Builder;

class PaginateFavoritesTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginateFavorites::modifyQuery
     */
    public function test()
    {
        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('where')->once()->withArgs(['user_id', 1]);
        $query->shouldReceive('where')->once()->withArgs(['guid', 'guid-1']);

        $request = new PaginateFavorites(['user_id' => 1, 'guid' => 'guid-1']);
        $request->modifyQuery($query);
    }

}