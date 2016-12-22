<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Page\Page;
use Ohio\Content\Page\Http\Requests\StorePage;
use Ohio\Content\Page\Http\Requests\PaginatePages;
use Ohio\Content\Page\Http\Requests\UpdatePage;
use Ohio\Content\Page\Http\Controllers\Api\PagesController;
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
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::__construct
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::get
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::show
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::destroy
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::update
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::store
     * @covers \Ohio\Content\Page\Http\Controllers\Api\PagesController::index
     */
    public function test()
    {

        $page1 = factory(Page::class)->make();

        $qbMock = $this->getPaginateQBMock(new PaginatePages(), [$page1]);

        $pageRepository = m::mock(Page::class);
        $pageRepository->shouldReceive('find')->with(1)->andReturn($page1);
        $pageRepository->shouldReceive('find')->with(999)->andReturn(null);
        $pageRepository->shouldReceive('create')->andReturn($page1);
        $pageRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new PagesController($pageRepository);
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
        $response = $controller->update(new UpdatePage(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create page
        $response = $controller->store(new StorePage());
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new PaginatePages());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($page1->name, $response->getData()->data[0]->name);

    }

}