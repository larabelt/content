<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Mockery as m;
use Tests\Belt\Core;
use Belt\Content\Http\Requests\PaginateFavorites;
use Illuminate\Database\Eloquent\Builder;

class PaginateFavoritesTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

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