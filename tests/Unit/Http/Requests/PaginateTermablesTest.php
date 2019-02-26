<?php namespace Tests\Belt\Content\Unit\Http\Requests;
use Mockery as m;
use Tests\Belt\Core;

use Belt\Content\Page;
use Belt\Content\Term;
use Belt\Content\Http\Requests\PaginateTermables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PaginateTermablesTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginateTermables::modifyQuery
     * @covers \Belt\Content\Http\Requests\PaginateTermables::items
     */
    public function test()
    {
        $page = new Page();
        $page->id = 1;
        $page->name = 'page';

        $term1 = new Term();
        $term1->id = 1;
        $term1->name = 'term 1';

        $qbMock = m::mock(Builder::class);
        $qbMock->shouldReceive('term')->once()->with('pages', 1);
        $qbMock->shouldReceive('notTerm')->once()->with('pages', 1);
        $qbMock->shouldReceive('get')->once()->andReturn(new Collection([$term1]));

        # modifyQuery
        $paginateRequest = new PaginateTermables(['termable_id' => 1, 'termable_type' => 'pages']);
        $paginateRequest->modifyQuery($qbMock);
        $paginateRequest->merge(['not' => true]);
        $paginateRequest->modifyQuery($qbMock);

        # items
        $paginateRequest->items($qbMock);
    }

}