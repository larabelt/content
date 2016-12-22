<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Block\Block;
use Ohio\Content\Block\Http\Requests\StoreBlock;
use Ohio\Content\Block\Http\Requests\PaginateBlocks;
use Ohio\Content\Block\Http\Requests\UpdateBlock;
use Ohio\Content\Block\Http\Controllers\Api\BlocksController;
use Ohio\Core\Base\Http\Exceptions\ApiNotFoundHttpException;

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
     * @covers \Ohio\Content\Block\Http\Controllers\Api\BlocksController::get
     * @covers \Ohio\Content\Block\Http\Controllers\Api\BlocksController::show
     * @covers \Ohio\Content\Block\Http\Controllers\Api\BlocksController::destroy
     * @covers \Ohio\Content\Block\Http\Controllers\Api\BlocksController::update
     * @covers \Ohio\Content\Block\Http\Controllers\Api\BlocksController::store
     * @covers \Ohio\Content\Block\Http\Controllers\Api\BlocksController::index
     */
    public function test()
    {

        $block1 = factory(Block::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateBlocks(), [$block1]);

        $blockRepository = m::mock(Block::class);
        $blockRepository->shouldReceive('find')->with(1)->andReturn($block1);
        $blockRepository->shouldReceive('find')->with(999)->andReturn(null);
        $blockRepository->shouldReceive('create')->andReturn($block1);
        $blockRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new BlocksController($blockRepository);
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
        $response = $controller->update(new UpdateBlock(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create block
        $response = $controller->store(new StoreBlock());
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new PaginateBlocks());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($block1->name, $response->getData()->data[0]->name);

    }

}