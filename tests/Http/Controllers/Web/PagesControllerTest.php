<?php

use Mockery as m;
use Ohio\Core\Testing;
use Ohio\Content\Http\Controllers\Web\PagesController;
use Ohio\Content\Page;
use Ohio\Content\Services\CompileService;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WebControllerTest extends Testing\OhioTestCase
{
    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Http\Controllers\Web\PagesController::__construct
     * @covers \Ohio\Content\Http\Controllers\Web\PagesController::get
     * @covers \Ohio\Content\Http\Controllers\Web\PagesController::show
     * @covers \Ohio\Content\Http\Controllers\Web\PagesController::preview
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

        $service = m::mock(CompileService::class);
        $service->shouldReceive('cache')->once()->with($page1)->andReturn('compiled');
        $service->shouldReceive('compile')->once()->with($page1)->andReturn('compiled');

        # construct
        $controller = new PagesController($pageRepository);
        $controller->service = $service;
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

        # preview
        $this->actAsSuper();
        $response = $controller->preview(1);
        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals($page1->name, array_get($response->getData(), 'page.name'));

    }

}