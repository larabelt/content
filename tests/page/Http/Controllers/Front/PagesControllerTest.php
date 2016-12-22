<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Page\Page;
use Ohio\Content\Page\Http\Controllers\Front\PagesController;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FrontControllerTest extends Testing\OhioTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Page\Http\Controllers\Front\PagesController::__construct
     * @covers \Ohio\Content\Page\Http\Controllers\Front\PagesController::get
     * @covers \Ohio\Content\Page\Http\Controllers\Front\PagesController::show
     */
    public function test()
    {

        # page 1
        $page1 = factory(Page::class)->make();
        $page1QBMock = m::mock(Builder::class);
        $page1QBMock->shouldReceive('first')->andReturn($page1);

        # missing page
        $pageNullQBMock = m::mock(Builder::class);
        $pageNullQBMock->shouldReceive('first')->andReturn(null);

        $pageRepository = m::mock(Page::class);

        $pageRepository->shouldReceive('where')->with('id', 1)->andReturn($page1QBMock);
        $pageRepository->shouldReceive('where')->with('slug', $page1->slug)->andReturn($page1QBMock);
        $pageRepository->shouldReceive('where')->with('id', 999)->andReturn($pageNullQBMock);

        # construct
        $controller = new PagesController($pageRepository);
        $this->assertEquals($pageRepository, $controller->page);

        # get existing page
        $page = $controller->get(1);
        $this->assertEquals($page1->name, $page->name);
        $page = $controller->get($page1->slug);
        $this->assertEquals($page1->name, $page->name);

        # get page that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(NotFoundHttpException::class, $e);
        }

        # show page
        $response = $controller->show(1);
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals($page1->name, array_get($response->getData(), 'page.name'));

    }

}