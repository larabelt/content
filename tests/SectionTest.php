<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SectionTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\Section::sectionable
     * @covers \Belt\Content\Section::getTemplateGroup
     */
    public function test()
    {
        $section = factory(Section::class)->make(['sectionable_type' => 'sections']);

        # sectionable
        $this->assertInstanceOf(MorphTo::class, $section->sectionable());

        # getTemplateGroup
        $section->sectionable_type = 'test';
        $this->assertEquals('test', $section->getTemplateGroup());

    }

}