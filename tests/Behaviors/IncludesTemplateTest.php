<?php

use Belt\Core\Testing;
use Belt\Content\Page;

class IncludesTemplateTest extends Testing\BeltTestCase
{

    /**
     * @covers \Belt\Content\Behaviors\IncludesTemplate::setTemplateAttribute
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateViewAttribute
     */
    public function test()
    {
        $templateStub = new Page();

        # template
        $templateStub->setTemplateAttribute(' Test ');
        $this->assertEquals('test', $templateStub->template);

        # template_view
        app()['config']->set('belt.templates.pages', [
            'default' => ['belt-content::pages.sections.default'],
            'pagetest' => 'belt-content::pages.sections.test',
        ]);
        $templateStub->template = 'missing';
        $this->assertEquals('belt-content::pages.sections.default', $templateStub->template_view);
        $templateStub->template = 'PageTest';
        $this->assertEquals('belt-content::pages.sections.test', $templateStub->template_view);
    }

}