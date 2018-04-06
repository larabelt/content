<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Builders\BaseBuilder;
use Belt\Content\Page;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Builder;

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
        $this->assertInstanceOf(Builder::class, $builder->sections());

        # section
        $section = m::mock(Section::class);
        $section->shouldReceive('saveParam')->andReturnNull();
        $builder->sections = m::mock(Builder::class);
        $builder->sections->shouldReceive('create')->withAnyArgs()->andReturn($section);
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