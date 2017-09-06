<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Builders\BaseBuilder;
use Belt\Content\Page;
use Belt\Content\Section;

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
        $this->assertInstanceOf(Section::class, $builder->sections());

        # section
        $section = factory(Section::class)->make();
        $sections = m::mock(Section::class);
        $sections->shouldReceive('create')->once()->andReturn($section);
        $builder->sections = $sections;
        $this->assertEquals($section, $builder->section());
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