<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SectionTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\Section::sectionable
     * @covers \Belt\Content\Section::getTemplateGroup
     * @covers \Belt\Content\Section::getSectionName
     * @covers \Belt\Content\Section::getNameAttribute
     * @covers \Belt\Content\Section::owner
     */
    public function test()
    {
        $section = factory(Section::class)->make(['sectionable_type' => 'sections']);

        # sectionable
        $this->assertInstanceOf(MorphTo::class, $section->sectionable());

        # getTemplateGroup
        $section->sectionable_type = 'test';
        $this->assertEquals('test', $section->getTemplateGroup());

        # getSectionName
        $this->assertNotEmpty($section->getSectionName());

        # owner
        $this->assertInstanceOf(MorphTo::class, $section->owner());

    }

}