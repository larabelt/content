<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Block\Block;
use Ohio\Content\Block\Http\Requests\CreateRequest;
use Ohio\Content\Block\Http\Requests\PaginateRequest;
use Ohio\Content\Block\Http\Requests\UpdateRequest;
use Ohio\Content\Block\Http\Controllers\ApiController;
use Ohio\Core\Base\Http\Exception\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiControllerTest extends Testing\OhioTestCase
{

    use Testing\TestPaginateTrait;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::__construct
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::get
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::show
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::destroy
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::update
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::store
     * @covers \Ohio\Content\Block\Http\Controllers\ApiController::index
     */
    public function test()
    {

        $block1 = factory(Block::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateRequest(), [$block1]);

        $blockRepository = m::mock(Block::class);
        $blockRepository->shouldReceive('find')->with(1)->andReturn($block1);
        $blockRepository->shouldReceive('find')->with(999)->andReturn(null);
        $blockRepository->shouldReceive('create')->andReturn($block1);
        $blockRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new ApiController($blockRepository);
        $this->assertEquals($blockRepository, $controller->block);

        # get existing block
        $block = $controller->get(1);
        $this->assertEquals($block1->name, $block->name);

        # get block that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(ApiNotFoundHttpException::class, $e);
        }

        # show block
        $response = $controller->show(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertEquals($block1->name, $data->name);

        # destroy block
        $response = $controller->destroy(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());

        # update block
        $response = $controller->update(new UpdateRequest(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create block
        $response = $controller->store(new CreateRequest());
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new Request());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($block1->name, $response->getData()->data[0]->name);

    }

}