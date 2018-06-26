<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Core\Behaviors\Paramable;
use Belt\Core\Behaviors\ParamableInterface;
use Belt\Core\Param;
use Belt\Content\Behaviors\IncludesTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class IncludesTemplateTest extends Testing\BeltTestCase
{

    /**
     * @covers \Belt\Content\Behaviors\IncludesTemplate::bootIncludesTemplate
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getDefaultTemplateKey
     * @covers \Belt\Content\Behaviors\IncludesTemplate::setTemplateAttribute
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateAttribute
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateConfigPrefix
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateConfig
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateGroup
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getTemplateViewAttribute
     * @covers \Belt\Content\Behaviors\IncludesTemplate::reconcileTemplateParams
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getParamConfig
     * @covers \Belt\Content\Behaviors\IncludesTemplate::getConfigAttribute
     */
    public function test()
    {
        # bootIncludesTemplate
        IncludesTemplateTestStub::bootIncludesTemplate();

        $templateStub = new IncludesTemplateTestStub();

        # template
        $templateStub->setTemplateAttribute(' Test ');
        $this->assertEquals('test', $templateStub->template);

        # getTemplateGroup
        $this->assertEquals('pages', $templateStub->getTemplateGroup());

        # template_view
        app()['config']->set('belt.templates.pages', [
            'default' => [
                'foo' => 'bar',
                'path' => 'belt-content::pages.sections.default',
                'params' => [
                    'class' => [
                        'options' => [
                            'col-md-3' => 'default',
                            'col-md-12' => 'wide',
                        ]
                    ],
                    'icon' => [
                        'default' => 'default',
                        'special' => 'special',
                    ],
                    'foo' => [
                        'type' => 'text',
                        'default' => 'bar',
                        'other' => 'other',
                    ],
                ]
            ],
            'pagetest' => 'belt-content::pages.sections.test',
        ]);
        $templateStub->template = 'missing';
        $this->assertEquals('belt-content::pages.sections.default', $templateStub->template_view);
        $templateStub->template = 'PageTest';
        $this->assertEquals('belt-content::pages.sections.test', $templateStub->template_view);

        # getTemplateConfig
        $templateStub->template = 'default';
        $this->assertEquals('bar', $templateStub->getTemplateConfig('foo'));
        $this->assertEquals('some-default', $templateStub->getTemplateConfig('missing', 'some-default'));

        # template_view (exception due to missing config)
        $missingStub = new IncludesTemplateTest2Stub();
        try {
            $missingStub->template_view;
            $this->exceptionNotThrown();
        } catch (\Exception $e) {

        }

        # reconcileTemplateParams where not paramable
        $notParamableStub = new IncludesTemplateTest2Stub();
        $notParamableStub->reconcileTemplateParams();

        /**
         * reconcileTemplateParams where paramable
         *
         * class param will remain unchanged
         * icon param value will be overwritten b/c current value is not in config
         * foo will be added as a new param with default value
         */
        $templateStub = new IncludesTemplateTest3Stub();
        $templateStub->reconcileTemplateParams();

        # getDefaultTemplateKey
        app()['config']->set('belt.templates.pages', [
            'pagetest' => 'belt-content::pages.sections.test',
            'pagetest2' => 'belt-content::pages.sections.test',
        ]);
        $templateStub = new IncludesTemplateTestStub();
        $this->assertEquals('pagetest', $templateStub->getDefaultTemplateKey());

        # getTemplateConfigPrefix
        $this->assertEquals('belt.templates.pages', $templateStub->getTemplateConfigPrefix());

        # getTemplateAttribute
        $templateStub->setAttribute('template', 'test');
        $this->assertEquals('test', $templateStub->template);

        # getParamConfig
        app()['config']->set('belt.templates.pages.foo', [
            'name' => 'test',
            'params' => [
                'foo' => 'bar'
            ],
        ]);
        $templateStub->template = 'foo';
        $this->assertEquals(config('belt.templates.pages.foo.params'), $templateStub->getParamConfig());

        # getConfigAttribute
        $this->assertEquals(config('belt.templates.pages.foo'), $templateStub->config);
    }

    public function tearDown()
    {
        m::close();
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

class IncludesTemplateTest3Stub extends Model implements ParamableInterface
{
    use IncludesTemplate;

    public function getMorphClass()
    {
        return 'pages';
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->params = new Collection();
        $this->params->add($this->mockParam('class', 'default'));
        $this->params->add($this->mockParam('icon', 'missing'));
    }

    public function mockParam($key, $value)
    {
        $param = m::mock(Param::class . '[getAttribute,update]');
        $param->shouldReceive('getAttribute')->with('key')->andReturn($key);
        $param->shouldReceive('getAttribute')->with('value')->andReturn($value);
        $param->shouldReceive('update')->andReturnSelf();

        return $param;
    }

    public function load($relations)
    {

    }

    public function params()
    {
        $builder = m::mock(Param::class);
        $builder->shouldReceive('create')->andReturn($this->mockParam('foo', 'value'));

        return $builder;
    }
}