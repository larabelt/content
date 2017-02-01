<?php

use Mockery as m;
use Ohio\Core\Testing;

use Ohio\Content\Block;
use Ohio\Content\Http\Requests\StoreBlock;
use Ohio\Content\Http\Requests\PaginateBlocks;
use Ohio\Content\Http\Requests\UpdateBlock;
use Ohio\Content\Http\Controllers\Api\BlocksController;
use Ohio\Core\Http\Exceptions\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlocksControllerTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::__construct
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::get
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::show
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::destroy
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::update
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::store
     * @covers \Ohio\Content\Http\Controllers\Api\BlocksController::index
     */
    public function test()
    {
        $this->actAsSuper();

        $block1 = factory(Block::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateBlocks(), [$block1]);

        $blockRepository = m::mock(Block::class);
        $blockRepository->shouldReceive('find')->with(1)->andReturn($block1);
        $blockRepository->shouldReceive('find')->with(999)->andReturn(null);
        $blockRepository->shouldReceive('create')->andReturn($block1);
        $blockRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new BlocksController($blockRepository);
        $this->assertEquals($blockRepository, $controller->blocks);

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
        $response = $controller->update(new UpdateBlock(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create block
        $response = $controller->store(new StoreBlock(['name' => 'test', 'body' => 'test']));
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new PaginateBlocks());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($block1->name, $response->getData()->data[0]->name);

    }

}