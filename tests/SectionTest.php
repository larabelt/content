<?php

use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Section;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SectionTest extends OhioTestCase
{
    /**
     * @covers \Ohio\Content\Section::sectionable
     * @covers \Ohio\Content\Section::getTemplateViewAttribute
     */
    public function test()
    {
        $section = factory(Section::class)->make(['sectionable_type' => 'sections']);

        # sectionable
        $this->assertInstanceOf(MorphTo::class, $section->sectionable());

        # getSectionViewAttribute
        app()['config']->set('ohio.content.sections.sections', [
            'default' => [
                'label' => 'Default Tout',
                'view' => 'ohio-content::section.sections.default'
            ],
            'sectiontest' => [
                'label' => 'Default Tout',
                'view' => 'ohio-content::section.sections.test'
            ],
        ]);
        $section->template = 'missing';
        $this->assertEquals('ohio-content::section.sections.default', $section->template_view);
        $section->template = 'SectionTest';
        $this->assertEquals('ohio-content::section.sections.test', $section->template_view);
    }

}