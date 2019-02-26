<?php namespace Tests\Belt\Content\Unit\Http\Requests;

use Mockery as m;
use Tests\Belt\Core;
use Belt\Content\Handle;
use Belt\Content\Http\Requests\PaginateHandles;
use Belt\Core\Pagination\DefaultLengthAwarePaginator;

class PaginateHandlesTest extends \Tests\Belt\Core\BeltTestCase
{

    use \Tests\Belt\Core\Base\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\PaginateHandles::modifyQuery
     */
    public function test()
    {
        $handle1 = new Handle();
        $handle1->delta = 1;
        $handle1->handleable_id = 1;
        $handle1->handleable_type = 'pages';

        # modifyQuery
        $qbMock = $this->getPaginateQBMock(new PaginateHandles(), [$handle1]);
        //$qbMock->shouldReceive('where')->once()->withArgs(['status', 1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['handleable_id', 1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['handleable_type', 'pages']);

        $paginator = new DefaultLengthAwarePaginator($qbMock, new PaginateHandles([
            //'status' => 1,
            'handleable_id' => 1,
            'handleable_type' => 'pages'
        ]));
        $paginator->build();
    }

}