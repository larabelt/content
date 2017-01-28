<?php

use Mockery as m;
use Ohio\Core\Testing;

use Ohio\Content\Handle;
use Ohio\Content\Http\Requests\PaginateHandles;
use Ohio\Core\Pagination\BaseLengthAwarePaginator;

class PaginateHandlesTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Http\Requests\PaginateHandles::modifyQuery
     */
    public function test()
    {
        $handle1 = new Handle();
        $handle1->delta = 1;
        $handle1->handleable_id = 1;
        $handle1->handleable_type = 'pages';

        # modifyQuery
        $qbMock = $this->getPaginateQBMock(new PaginateHandles(), [$handle1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['delta', 1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['handleable_id', 1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['handleable_type', 'pages']);

        new BaseLengthAwarePaginator($qbMock, new PaginateHandles([
            'delta' => 1,
            'handleable_id' => 1,
            'handleable_type' => 'pages'
        ]));
    }

}