<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Page\Page;
use Ohio\Content\Page\Http\Requests\CreateRequest;
use Ohio\Content\Page\Http\Requests\PaginateRequest;
use Ohio\Content\Page\Http\Requests\UpdateRequest;
use Ohio\Content\Page\Http\Controllers\Api\HandlesController;
use Ohio\Core\Base\Http\Exceptions\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiControllerTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::__construct
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::get
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::show
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::destroy
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::update
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::store
     * @covers \Ohio\Content\Page\Http\Controllers\ApiController::index
     */
    public function test()
    {

        $page1 = factory(Page::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginateRequest(), [$page1]);

        $pageRepository = m::mock(Page::class);
        $pageRepository->shouldReceive('find')->with(1)->andReturn($page1);
        $pageRepository->shouldReceive('find')->with(999)->andReturn(null);
        $pageRepository->shouldReceive('create')->andReturn($page1);
        $pageRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new HandlesController($pageRepository);
        $this->assertEquals($pageRepository, $controller->page);

        # get existing page
        $page = $controller->get(1);
        $this->assertEquals($page1->name, $page->name);

        # get page that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(ApiNotFoundHttpException::class, $e);
        }

        # show page
        $response = $controller->show(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertEquals($page1->name, $data->name);

        # destroy page
        $response = $controller->destroy(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());

        # update page
        $response = $controller->update(new UpdateRequest(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create page
        $response = $controller->store(new CreateRequest());
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new Request());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($page1->name, $response->getData()->data[0]->name);

    }

}