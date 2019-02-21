<?php namespace Tests\Belt\Content\Unit;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SectionTest extends BeltTestCase
{
    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Section::getNameAttribute
     * @covers \Belt\Content\Section::owner
     * @covers \Belt\Content\Section::getSubtypeSubgroupAttribute
     * @covers \Belt\Content\Section::toArray
     * @covers \Belt\Content\Section::children
     * @covers \Belt\Content\Section::getSectionsAttribute
     * @covers \Belt\Content\Section::scopeOwned
     * @covers \Belt\Content\Section::getPreviewAttribute
     *
     * @covers \Belt\Content\Section::sectionable
     * zcovers \Belt\Content\Section::copy
     * zcovers \Belt\Content\Section::getRelationshipFromMethod
     * zcovers \Belt\Content\Section::getSubtypeGroup
     * zcovers \Belt\Content\Section::getSectionName
     */
    public function test()
    {
        # getNameAttribute
        $section = factory(Section::class)->make(['subtype' => 'foo.bar']);
        $this->assertEquals('Foo [Bar]', $section->getNameAttribute());
        app()['config']->set('belt.subtypes.sections.foo.bar.name', function () {
            return 'foo';
        });
        $this->assertEquals('foo', $section->getNameAttribute());

        # getSubtypeSubgroupAttribute
        $this->assertEquals('foo', $section->subtypeSubgroup);

        # toArray
        $array = $section->toArray();
        $this->assertTrue(isset($array['children']));

        # children / sections
        $this->assertEquals($section->children, $section->sections);

        # preview
        app()['config']->set('belt.subtypes.sections.foo.bar.preview', function () {
            return view('belt-content::sections.previews.default', ['section' => $this]);
        });
        $params = new \Illuminate\Database\Eloquent\Collection();
        $params->add(new \Belt\Core\Param(['key' => 'foo', 'value' => 'bar']));
        $params->add(new \Belt\Core\Param(['key' => 'hello', 'value' => 'world']));
        $section->params = $params;
        $this->assertTrue(str_contains($section->preview, ['foo']));
        $this->assertTrue(str_contains($section->preview, ['world']));

        # scopeOwned
        $qb = m::mock(\Illuminate\Database\Eloquent\Builder::class);
        $qb->shouldReceive('select')->with(['sections.*'])->andReturnSelf();
        $qb->shouldReceive('where')->with('sections.owner_type', 'pages')->andReturnSelf();
        $qb->shouldReceive('where')->with('sections.owner_id', 1)->andReturnSelf();
        $section->scopeOwned($qb, 'pages', 1);

        # copy (done in functional test, for now)

        # owner
        $this->assertInstanceOf(MorphTo::class, $section->owner());

        # sectionable
        $this->assertInstanceOf(MorphTo::class, $section->sectionable());

    }

}