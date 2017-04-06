<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Page;
use Belt\Content\Services\CompileService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class CompileServiceTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Services\CompileService::compile
     * @covers \Belt\Content\Services\CompileService::searchable
     */
    public function test()
    {
        View::shouldReceive('make')->andReturnSelf();
        View::shouldReceive('render')->andReturn('<div>hello</div>');

        # compile
        $page = m::mock(Page::class . '[save,setAttribute,getTemplateViewAttribute]');
        $page->shouldReceive('getTemplateViewAttribute')->andReturn('default');
        $page->shouldReceive('setAttribute')->andReturnSelf();
        $page->shouldReceive('save')->once()->andReturnSelf();
        $page->sections = new Collection();

        $service = m::mock(CompileService::class . '[searchable]');
        $service->shouldReceive('searchable')->once()->andReturnSelf();
        $response = $service->compile($page);
        $this->assertTrue(is_string($response));

        # searchable
        $page = m::mock(Page::class);
        $service = new CompileService();
        $result = $service->searchable($page, '<div>test</div>');
        $this->assertEquals('test', $result);

        # searchable (exception)
        try {
            $service->searchable($page, '!@#$%^&*()_');
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }

    }

    /**
     * @covers \Belt\Content\Services\CompileService::cache
     */
    public function testCache()
    {
        Page::unguard();

        $service = m::mock(CompileService::class . '[compile]');
        $service->shouldReceive('compile')->andReturn('compiled');

        # cache (unforced)
        $page = factory(Page::class)->make();
        $page->id = 1;
        $page->template = 'belt-content::pages.templates.default';
        $cacheKey = sprintf('compiled-%s-%s', $page->getMorphClass(), $page->id);
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn('compiled');
        Cache::shouldReceive('add')->once()->with($cacheKey, 'compiled', 3600);
        $result = $service->cache($page);
        $this->assertEquals('compiled', $result);

        # cache (forced)
        $page = factory(Page::class)->make();
        $page->id = 1;
        $page->template = 'belt-content::pages.templates.default';
        $cacheKey = sprintf('compiled-%s-%s', $page->getMorphClass(), $page->id);
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn('compiled');
        Cache::shouldReceive('put')->once()->with($cacheKey, 'compiled', 3600);
        $result = $service->cache($page, true);
        $this->assertEquals('compiled', $result);
    }

}
