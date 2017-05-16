<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Page;
use Belt\Content\Handle;
use Illuminate\Database\Eloquent\Builder;

class HandleTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Handle::__toString
     * @covers \Belt\Content\Handle::setUrlAttribute
     * @covers \Belt\Content\Handle::handleable
     * @covers \Belt\Content\Handle::normalizeUrl
     * @covers \Belt\Content\Handle::scopeHandled
     * @covers \Belt\Content\Handle::syncDefault
     * @covers \Belt\Content\Handle::config
     * @covers \Belt\Content\Handle::getConfigAttribute
     */
    public function test()
    {

        # normalizeUrl
        $this->assertEquals('/one', Handle::normalizeUrl('one'));
        $this->assertEquals('/one/123/what-just-happened', Handle::normalizeUrl("One/123!!!/What Just Happened?"));

        Page::unguard();
        $page = factory(Page::class)->make();
        $page->id = 1;

        Handle::unguard();
        $handle = factory(Handle::class)->make();
        $handle->handleable_id = 1;
        $handle->handleable_type = $page->getMorphClass();
        $handle->url = ' Test/test it all ';
        $handle->delta = 1;
        $handle->handleable()->add($page);

        $attributes = $handle->getAttributes();

        # setters
        $this->assertEquals('/test/test-it-all', $handle->__toString());
        $this->assertEquals('/test/test-it-all', $attributes['url']);
        $this->assertEquals('pages', $attributes['handleable_type']);

        # scopeHandled
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('select')->with(['handles.*'])->andReturnSelf();
        $qb->shouldReceive('where')->with('handles.handleable_type', 'pages')->andReturnSelf();
        $qb->shouldReceive('where')->with('handles.handleable_id', 1)->andReturnSelf();
        $handle->scopeHandled($qb, 'pages', 1);

        # config
        app()['config']->set('belt.content.handles.responses.test', [
            'foo' => 'bar'
        ]);
        $handle->setAttribute('config_name', 'test');
        $this->assertEquals(['foo' => 'bar'], $handle->config);
        $this->assertEquals(['foo' => 'bar'], $handle->config());
        $this->assertEquals('bar', $handle->config('foo'));
        $this->assertEquals('default', $handle->config('missing', 'default'));



    }

    /**
     * @covers \Belt\Content\Handle::syncDefault
     */
    public function testsyncDefault()
    {
        app()['config']->set('belt.content.handles.responses.test', ['show_default' => true]);

        Page::unguard();
        $page = factory(Page::class)->make();
        $page->id = 1;

        $qb1 = m::mock(Builder::class);
        $qb1->shouldReceive('where')->with('is_default', true)->andReturnSelf();
        $qb1->shouldReceive('where')->with('id', '!=', 1)->andReturnSelf();
        $qb1->shouldReceive('update')->with(['is_default' => false])->andReturnSelf();
        $qb1->shouldReceive('count')->andReturn(2);

        Handle::unguard();
        $handle = m::mock(Handle::class . '[handled, save]');
        $handle->id = 1;
        $handle->shouldReceive('handled')->andReturn($qb1);
        $handle->shouldReceive('save')->andReturnSelf();

        # lack of handelable returns false
        $handle->handleable = null;
        $handle->syncDefault();

        # skips sync operation if config type doesn't need it
        $handle->handleable = $page;
        $handle->syncDefault();

        # carry out operation otherwise
        $handle->setAttribute('config_name', 'test');
        $handle->syncDefault();
    }

}