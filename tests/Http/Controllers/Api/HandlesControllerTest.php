<?php

use Mockery as m;
use Belt\Core\Testing;

use Belt\Content\Handle;
use Belt\Content\Http\Requests\StoreHandle;
use Belt\Content\Http\Requests\PaginateHandles;
use Belt\Content\Http\Requests\UpdateHandle;
use Belt\Content\Http\Controllers\Api\HandlesController;
use Belt\Core\Http\Exceptions\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HandlesControllerTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::__construct
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::get
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::show
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::destroy
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::update
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::store
     * @covers \Belt\Content\Http\Controllers\Api\HandlesController::index
     */
    public function test()
    {
        $this->actAsSuper();

        $handle1 = factory(Handle::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateHandles(), [$handle1]);

        $handleRepository = m::mock(Handle::class);
        $handleRepository->shouldReceive('find')->with(1)->andReturn($handle1);
        $handleRepository->shouldReceive('find')->with(999)->andReturn(null);
        $handleRepository->shouldReceive('create')->andReturn($handle1);
        $handleRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new HandlesController($handleRepository);
        $this->assertEquals($handleRepository, $controller->handle);

        # get existing handle
        $handle = $controller->get(1);
        $this->assertEquals($handle1->url, $handle->url);

        # get handle that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(ApiNotFoundHttpException::class, $e);
        }

        # show handle
        $response = $controller->show(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertEquals($handle1->url, $data->url);

        # destroy handle
        $response = $controller->destroy(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());

        # update handle
        $response = $controller->update(new UpdateHandle(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create handle
        $response = $controller->store(new StoreHandle());
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new PaginateHandles());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($handle1->url, $response->getData()->data[0]->url);

    }

}