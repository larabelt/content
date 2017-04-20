<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Http\Requests\PaginatePosts;
use Illuminate\Database\Eloquent\Builder;

class PaginatePostsTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginatePosts::modifyQuery
     */
    public function test()
    {
        $post_at_year = 2001;

        # modifyQuery
        $query = m::mock(Builder::class);
        $query->shouldReceive('whereBetween')->once()->withArgs(['post_at', ["$post_at_year-01-01 00:00:00", "$post_at_year-12-31 23:59:59"]]);

        $request = new PaginatePosts(['post_at_year' => $post_at_year]);
        $request->modifyQuery($query);
    }

}