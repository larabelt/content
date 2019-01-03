<?php

use Mockery as m;
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
    }

    /**
     * @covers \Belt\Content\Behaviors\Handleable::handles
     * @covers \Belt\Content\Behaviors\Handleable::getHandleAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getDefaultUrlAttribute
     * @covers \Belt\Content\Behaviors\Handleable::getSimpleUrlAttribute
     */
    public function test()
    {

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

}

class HandleableTestStub extends Model
{
    use Handleable;
}