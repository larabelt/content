<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Page;
use Belt\Content\Section;
use Belt\Content\Tout;
use Belt\Content\Services\CompileService;
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
     * @covers \Belt\Content\Services\CompileService::crawl
     * @covers \Belt\Content\Services\CompileService::__crawl
     * @covers \Belt\Content\Services\CompileService::compile
     * @covers \Belt\Content\Services\CompileService::getSearchable
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

        $service = m::mock(CompileService::class . '[crawl]');
        $service->shouldReceive('crawl')->once()->andReturnSelf();
        $response = $service->compile($page);
        $this->assertTrue(is_string($response));

        # crawl
        Page::unguard();
        Section::unguard();
        Tout::unguard();

        $page = new Page();
        $page->sections = new Collection();

        $section1 = new Section(['heading' => 'foo']);
        $section1->sectionable = new Tout(['heading' => 'tout']);
        $section2 = new Section(['heading' => 'bar']);
        $section2->children = new Collection([new Section(['heading' => 'child'])]);

        $page->sections->push($section1);
        $page->sections->push($section2);

        $service = new CompileService();
        $result = $service->crawl($page);

        $this->assertContains('foo', $result);
        $this->assertContains('bar', $result);
        $this->assertContains('child', $result);
        $this->assertContains('tout', $result);

        # crawl (exception)
        try {
            $section1->before = '!@#$%^&*()_';
            //$service->crawl($page, '!@#$%^&*()_');
            $service->crawl($page);
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }

    }

    /**
     * @covers \Belt\Content\Services\CompileService::compile
     */
    public function testCompileException()
    {
        $page = factory(Page::class)->make();

        View::shouldReceive('make')->andThrow(new \Exception());

        $service = new CompileService();
        $service->compile($page);
    }

    /**
     * @covers \Belt\Content\Services\CompileService::cache
     */
    public function ztestCache()
    {
        Page::unguard();

        $service = m::mock(CompileService::class . '[compile]');
        $service->shouldReceive('compile')->andReturn('compiled');

        # cache (unforced)
        $page = factory(Page::class)->make();
        $page->id = 1;
        $page->template = 'belt-content::pages.templates.default';
        $cacheKey = $page->getHasSectionsCacheKey();
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn('compiled');
        $result = $service->cache($page);
        $this->assertEquals('compiled', $result);
    }

    /**
     * @covers \Belt\Content\Services\CompileService::cache
     */
    public function testCacheForced()
    {
        Page::unguard();

        View::shouldReceive('make')->andReturnSelf();
        View::shouldReceive('render')->andReturn('compiled');

        $service = new CompileService();

        # cache (forced)
        $page = factory(Page::class)->make();
        $page->id = 1;
        $page->template = 'belt-content::pages.templates.default';
        $cacheKey = $page->getHasSectionsCacheKey();
        Cache::shouldReceive('forget')->twice()->with($cacheKey);
        Cache::shouldReceive('get')->once()->with($cacheKey)->andReturn(false);
        Cache::shouldReceive('put')->once()->with($cacheKey, 'compiled', 60);
        $result = $service->cache($page, true);
        $this->assertEquals('compiled', $result);
    }

}
