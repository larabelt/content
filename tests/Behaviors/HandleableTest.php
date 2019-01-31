<?php

use Mockery as m;
use Belt\Core\Translation;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Behaviors\Handleable;
use Belt\Content\Handle;
use Belt\Content\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;

class HandleableTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        parent::setUp();
        Handle::unguard();
        Page::unguard();
        Translation::unguard();
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::bootHandleable
     * @covers \Belt\Content\Behaviors\Handleable::handles
     * @covers \Belt\Content\Behaviors\Handleable::getHandleAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getDefaultUrlAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getSimpleUrlAttribute
     */
    public function test()
    {
        # bootHandleable
        Page::bootHandleable();

        # handles
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderBy')->withArgs(['is_default', 'desc']);
        $pageMock = m::mock(HandleableTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphMany')->withArgs([Handle::class, 'handleable'])->andReturn($morphMany);
        $pageMock->shouldReceive('handles');
        $pageMock->handles();

        # getDefaultUrlAttribute
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection();
        $this->assertEquals('/pages/1/test', $page->getDefaultUrlAttribute());

        $handle = new Handle(['url' => '/test', 'is_default' => true]);
        $page->handles->push($handle);
        $this->assertEquals('/test', $page->getDefaultUrlAttribute());

        # getSimpleUrlAttribute
        $this->assertEquals('/pages/1/test', $page->getSimpleUrlAttribute());
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::getHandleAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getDefaultUrlAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getSimpleUrlAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getTranslatedLinks
     */
    public function test2()
    {
        $this->enableI18n();

        # getSimpleUrlAttribute
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $this->assertEquals('/en_US/pages/1/test', $page->getSimpleUrlAttribute());

        # getDefaultUrlAttribute
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection();
        $handle = new Handle([
            'subtype' => 'alias',
            'locale' => 'en_US',
            'url' => '/test',
            'is_default' => true,
        ]);
        $page->handles->push($handle);
        $this->assertEquals('/en_US/test', $page->getDefaultUrlAttribute());
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::getHandle
     */
    public function testGetHandle()
    {
        // default handle already attached
        $defaultHandle = new Handle(['url' => '/default', 'is_default' => true]);
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection([$defaultHandle]);
        $this->assertEquals($defaultHandle, $page->getHandle());

        // implied handle w/o i18n
        $impliedHandle = new Handle([
            'subtype' => 'alias',
            'handleable_type' => 'pages',
            'handleable_id' => 1,
            'url' => '/pages/1/implied',
        ]);
        $page = new Page(['id' => 1, 'slug' => 'implied']);
        $this->assertEquals($impliedHandle, $page->getHandle(false));
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::getHandle
     */
    public function testGetHandle2()
    {
        $this->enableI18n();

        // default handle already attached
        $defaultHandle = new Handle(['locale' => 'es_ES', 'url' => '/ya-existe', 'is_default' => true]);
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection([$defaultHandle]);
        $this->assertEquals($defaultHandle, $page->getHandle());

        // implied handle w/i18n
        $impliedHandle = new Handle([
            'subtype' => 'alias',
            'handleable_type' => 'pages',
            'handleable_id' => 1,
            'url' => '/pages/1/implicado',
        ]);
        $translation = new Translation(['locale' => 'es_ES', 'translatable_column' => 'slug', 'value' => 'implicado']);
        $page = new Page(['id' => 1, 'slug' => 'implied-i18n']);
        $page->translations = new Collection([$translation]);
        $this->assertEquals($impliedHandle, $page->getHandle(true, 'es_ES'));
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::getTranslatedLinks
     */
    public function testGetTranslatedLinks()
    {
        $this->enableI18n();

        // w/prefixed links
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection([
            new Handle(['locale' => 'en_US', 'url' => '/foo', 'is_default' => true]),
        ]);
        $links = [
            'en_US' => '/en_US/foo',
            'es_ES' => '/es_ES/foo',
        ];
        $this->assertEquals($links, $page->getTranslatedLinks());
        $this->assertEquals($links, $page->getTranslatedLinks()); // after $page->translatedLinks is not null

        // w/prefixed links 2
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection([
            new Handle(['locale' => 'en_US', 'url' => '/foo']),
            new Handle(['locale' => 'es_ES', 'url' => '/bar']),
        ]);
        $links = [
            'en_US' => '/en_US/foo',
            'es_ES' => '/es_ES/bar',
        ];
        $this->assertEquals($links, $page->getTranslatedLinks());
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::getTranslatedLinks
     */
    public function testGetTranslatedLinks2()
    {
        $this->enableI18n();

        // wo/prefixed links
        app()['config']->set('belt.core.translate.prefix-urls', false);
        $page = new Page(['id' => 1, 'slug' => 'test']);
        $page->handles = new Collection([
            new Handle(['locale' => 'en_US', 'url' => '/foo']),
            new Handle(['locale' => 'es_ES', 'url' => '/bar']),
        ]);
        $links = [
            'en_US' => '/foo',
            'es_ES' => '/bar',
        ];
        $this->assertEquals($links, $page->getTranslatedLinks());
    }

}

class HandleableTestStub extends Model
{
    use Handleable;
}