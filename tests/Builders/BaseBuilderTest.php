<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Builders\BaseBuilder;
use Belt\Content\Page;
use Belt\Content\Section;
use Kalnoy\Nestedset\QueryBuilder;

class BaseBuilderTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Builders\BaseBuilder::__construct
     * @covers \Belt\Content\Builders\BaseBuilder::sections
     * @covers \Belt\Content\Builders\BaseBuilder::section
     */
    public function test()
    {

        $page = factory(Page::class)->make();

        # __construct
        $builder = new BaseBuilderTestStub($page);
        $this->assertEquals($page, $builder->item);

        # sections
        $this->assertInstanceOf(QueryBuilder::class, $builder->sections());

        # section
        $section = m::mock(Section::class);
        $section->shouldReceive('saveParam')->with('foo', 'bar')->andReturnSelf();

        $sections = m::mock(QueryBuilder::class);
        $sections->shouldReceive('create')->once()->andReturn($section);
        $builder->sections = $sections;

        $this->assertEquals($section, $builder->section(['params' => ['foo' => 'bar']]));
    }

}

class BaseBuilderTestStub extends BaseBuilder
{
    public function build()
    {
        $this->section([
            'heading' => 'test',
        ]);
    }
}