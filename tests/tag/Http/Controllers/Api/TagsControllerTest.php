<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Tag\Tag;
use Ohio\Content\Tag\Http\Requests\CreateRequest;
use Ohio\Content\Tag\Http\Requests\PaginateRequest;
use Ohio\Content\Tag\Http\Requests\UpdateRequest;
use Ohio\Content\Tag\Http\Controllers\ApiController;
use Ohio\Core\Base\Http\Exceptions\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagsControllerTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::__construct
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::get
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::show
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::destroy
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::update
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::store
     * @covers \Ohio\Content\Tag\Http\Controllers\ApiController::index
     */
    public function test()
    {

        $tag1 = factory(Tag::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateRequest(), [$tag1]);

        $tagRepository = m::mock(Tag::class);
        $tagRepository->shouldReceive('find')->with(1)->andReturn($tag1);
        $tagRepository->shouldReceive('find')->with(999)->andReturn(null);
        $tagRepository->shouldReceive('create')->andReturn($tag1);
        $tagRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new ApiController($tagRepository);
        $this->assertEquals($tagRepository, $controller->tag);

        # get existing tag
        $tag = $controller->get(1);
        $this->assertEquals($tag1->name, $tag->name);

        # get tag that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(ApiNotFoundHttpException::class, $e);
        }

        # show tag
        $response = $controller->show(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertEquals($tag1->name, $data->name);

        # destroy tag
        $response = $controller->destroy(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());

        # update tag
        $response = $controller->update(new UpdateRequest(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create tag
        $response = $controller->store(new CreateRequest());
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new Request());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($tag1->name, $response->getData()->data[0]->name);

    }

}