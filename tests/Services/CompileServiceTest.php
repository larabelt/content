<?php

use Mockery as m;
use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Page;
use Ohio\Content\Services\CompileService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class CompileServiceTest extends OhioTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Services\CompileService::__construct
     * @covers \Ohio\Content\Services\CompileService::compile
     */
    public function test()
    {
        $service = new CompileService();

        # construct / config
        $this->assertInstanceOf(Page::class, $service->pages);


        $page = factory(Page::class)->make();
        $page->template = 'ohio-content::pages.templates.default';

        # compile
        $response = $service->compile($page);
        $this->assertTrue(is_string($response));
    }

    /**
     * @covers \Ohio\Content\Services\CompileService::pages
     */
    public function testPages()
    {
        $pages = factory(Page::class, 2)->make();

        $pagesRepo = m::mock(Builder::class);
        $pagesRepo->shouldReceive('where')->andReturnSelf();
        $pagesRepo->shouldReceive('query')->andReturnSelf();
        $pagesRepo->shouldReceive('get')->andReturn($pages);

        $service = m::mock(CompileService::class . '[cache]');
        $service->pages = $pagesRepo;
        $service->shouldReceive('cache')->with($pages->offsetGet(0), true);
        $service->shouldReceive('cache')->with($pages->offsetGet(1), true);

        $service->pages();
    }


    /**
     * @covers \Ohio\Content\Services\CompileService::cache
     */
    public function testCache()
    {
        $service = m::mock(CompileService::class . '[compile]');
        $service->shouldReceive('compile')->andReturn('compiled');

        # cache (unforced)
        $page = factory(Page::class)->make();
        $page->template = 'ohio-content::pages.templates.default';
        $cacheKey = 'pages:' . $page->id;
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn('compiled');
        Cache::shouldReceive('add')->once()->with($cacheKey, 'compiled', 3600);
        $result = $service->cache($page);
        $this->assertEquals('compiled', $result);

        # cache (forced)
        $page = factory(Page::class)->make();
        $page->template = 'ohio-content::pages.templates.default';
        $cacheKey = 'pages:' . $page->id;
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn('compiled');
        Cache::shouldReceive('put')->once()->with($cacheKey, 'compiled', 3600);
        $result = $service->cache($page, true);
        $this->assertEquals('compiled', $result);
    }

}
