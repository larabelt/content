<?php

use Mockery as m;
use Ohio\Core\Testing;

use Ohio\Content\Tout;
use Ohio\Content\Http\Requests\StoreTout;
use Ohio\Content\Http\Requests\PaginateTouts;
use Ohio\Content\Http\Requests\UpdateTout;
use Ohio\Content\Http\Controllers\Api\ToutsController;
use Ohio\Core\Http\Exceptions\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ToutsControllerTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::__construct
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::get
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::show
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::destroy
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::update
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::store
     * @covers \Ohio\Content\Http\Controllers\Api\ToutsController::index
     */
    public function test()
    {
        $this->actAsSuper();

        $tout1 = factory(Tout::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateTouts(), [$tout1]);

        $toutRepository = m::mock(Tout::class);
        $toutRepository->shouldReceive('find')->with(1)->andReturn($tout1);
        $toutRepository->shouldReceive('find')->with(999)->andReturn(null);
        $toutRepository->shouldReceive('create')->andReturn($tout1);
        $toutRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new ToutsController($toutRepository);
        $this->assertEquals($toutRepository, $controller->touts);

        # get existing tout
        $tout = $controller->get(1);
        $this->assertEquals($tout1->name, $tout->name);

        # get tout that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(ApiNotFoundHttpException::class, $e);
        }

        # show tout
        $response = $controller->show(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertEquals($tout1->name, $data->name);

        # destroy tout
        $response = $controller->destroy(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());

        # update tout
        $response = $controller->update(new UpdateTout(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create tout
        $response = $controller->store(new StoreTout(['name' => 'test', 'body' => 'test']));
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new PaginateTouts());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($tout1->name, $response->getData()->data[0]->name);

    }

}