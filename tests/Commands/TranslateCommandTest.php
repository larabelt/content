<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Core\Facades\MorphFacade as Morph;
use Belt\Core\Facades\TranslateFacade as Translate;
use Belt\Content\Commands\TranslateCommand;
use Belt\Content\Handle;
use Belt\Content\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TranslateCommandTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Commands\TranslateCommand::handle
     * @covers \Belt\Content\Commands\TranslateCommand::handles
     */
    public function testHandle()
    {
        $this->enableI18n();

        $handle = factory(Handle::class)->make(['url' => 'foo']);

        $handles = m::mock(Builder::class);
        $handles->shouldReceive('create')->andReturn($handle);

        Page::unguard();
        $page = m::mock(Page::class);
        $page->shouldReceive('getAttribute')->with('name')->andReturn('Foo Page');
        $page->shouldReceive('getAttribute')->with('slug')->andReturn('foo');
        $page->shouldReceive('getAttribute')->with('handles')->andReturn(new Collection());
        $page->shouldReceive('handles')->andReturn($handles);

        $pages = new Collection();
        $pages->add($page);

        $qb = m::mock(Builder::class);
        $qb->shouldReceive('whereIn')->with('id', [1])->andReturnSelf();
        $qb->shouldReceive('get')->andReturn($pages);

        Morph::shouldReceive('type2QB')->with('pages')->andReturn($qb);
        Translate::shouldReceive('isAvailableLocale')->with('es_ES')->andReturn(true);
        Translate::shouldReceive('translate')->with($page->name, 'es_ES');

        $cmd = m::mock(TranslateCommand::class . '[argument,option,info]');
        $cmd->shouldReceive('argument')->with('action')->andReturn('handles');
        $cmd->shouldReceive('option')->with('id', '')->andReturn(1);
        $cmd->shouldReceive('option')->with('type', '')->andReturn('pages');
        $cmd->shouldReceive('option')->with('locale', '')->andReturn('es_ES');
        $cmd->shouldReceive('option')->with('limit')->andReturn(1);
        $cmd->shouldReceive('option')->with('debug')->andReturn(true);
        $cmd->shouldReceive('info')->andReturnSelf();

        $cmd->handle();
    }

}