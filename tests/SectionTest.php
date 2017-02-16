<?php

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Section;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SectionTest extends BeltTestCase
{
    /**
     * @covers \Belt\Content\Section::sectionable
     * @covers \Belt\Content\Section::getTemplateViewAttribute
     */
    public function test()
    {
        $section = factory(Section::class)->make(['sectionable_type' => 'sections']);

        # sectionable
        $this->assertInstanceOf(MorphTo::class, $section->sectionable());

        # getSectionViewAttribute
        app()['config']->set('belt.templates.sections', [
            'default' => ['belt-content::sections.sections.default'],
            'sectiontest' => 'belt-content::sections.sections.test',
        ]);
        $section->template = 'missing';
        $this->assertEquals('belt-content::sections.sections.default', $section->template_view);
        $section->template = 'SectionTest';
        $this->assertEquals('belt-content::sections.sections.test', $section->template_view);
    }

}