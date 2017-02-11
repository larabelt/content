<?php

use Ohio\Core\Testing;
use Ohio\Content\Page;

class IncludesTemplateTest extends Testing\OhioTestCase
{

    /**
     * @covers \Ohio\Content\Behaviors\IncludesTemplate::setTemplateAttribute
     * @covers \Ohio\Content\Behaviors\IncludesTemplate::getTemplateViewAttribute
     */
    public function test()
    {
        $templateStub = new Page();

        # template
        $templateStub->setTemplateAttribute(' Test ');
        $this->assertEquals('test', $templateStub->template);

        # template_view
        app()['config']->set('ohio.content.templates.pages', [
            'default' => [
                'label' => 'Default Page',
                'view' => 'ohio-content::pages.sections.default'
            ],
            'pagetest' => [
                'label' => 'Test Page',
                'view' => 'ohio-content::pages.sections.test'
            ],
        ]);
        $templateStub->template = 'missing';
        $this->assertEquals('ohio-content::pages.sections.default', $templateStub->template_view);
        $templateStub->template = 'PageTest';
        $this->assertEquals('ohio-content::pages.sections.test', $templateStub->template_view);
    }

}