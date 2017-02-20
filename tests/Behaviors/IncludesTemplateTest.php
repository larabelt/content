<?php

use Belt\Core\Testing;
use Belt\Content\Page;
use Belt\Content\Behaviors\IncludesTemplate;
use Illuminate\Database\Eloquent\Model;

class IncludesTemplateTest extends Testing\BeltTestCase
{

    /**
     * @covers \Belt\Content\Behaviors\IncludesTemplate::setTemplateAttribute
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateGroup
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateViewAttribute
     */
    public function test()
    {
        $templateStub = new IncludesTemplateTestStub();

        # template
        $templateStub->setTemplateAttribute(' Test ');
        $this->assertEquals('test', $templateStub->template);

        # getTemplateGroup
        $this->assertEquals('pages', $templateStub->getTemplateGroup());

        # template_view
        app()['config']->set('belt.templates.pages', [
            'default' => ['belt-content::pages.sections.default'],
            'pagetest' => 'belt-content::pages.sections.test',
        ]);
        $templateStub->template = 'missing';
        $this->assertEquals('belt-content::pages.sections.default', $templateStub->template_view);
        $templateStub->template = 'PageTest';
        $this->assertEquals('belt-content::pages.sections.test', $templateStub->template_view);

        # template_view (exception due to missing config)
        $templateStub = new IncludesTemplateTest2Stub();
        try {
            $templateStub->template_view;
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }
    }

}

class IncludesTemplateTestStub extends Model
{
    use IncludesTemplate;

    public function getMorphClass()
    {
        return 'pages';
    }
}

class IncludesTemplateTest2Stub extends Model
{
    use IncludesTemplate;

    public function getMorphClass()
    {
        return 'something-else-that-is-missing-a-config-file';
    }
}