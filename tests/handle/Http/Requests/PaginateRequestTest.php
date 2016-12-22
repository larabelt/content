<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Handle\Handle;
use Ohio\Content\Handle\Http\Requests\PaginateRequest;
use Ohio\Core\Base\Pagination\BaseLengthAwarePaginator;

class PaginateRequestTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Handle\Http\Requests\PaginateRequest::modifyQuery
     */
    public function test()
    {
        $handle1 = new Handle();
        $handle1->delta = 1;
        $handle1->handleable_id = 1;
        $handle1->handleable_type = 'content/page';

        # modifyQuery
        $qbMock = $this->getPaginateQBMock(new PaginateRequest(), [$handle1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['delta', 1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['handleable_id', 1]);
        $qbMock->shouldReceive('where')->once()->withArgs(['handleable_type', 'content/page']);

        new BaseLengthAwarePaginator($qbMock, new PaginateRequest([
            'delta' => 1,
            'handleable_id' => 1,
            'handleable_type' => 'content/page'
        ]));
    }

}