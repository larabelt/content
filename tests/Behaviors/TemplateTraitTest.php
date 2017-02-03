<?php

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Behaviors\TemplateTrait;

class TemplateTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Behaviors\TemplateTrait::setTemplateAttribute
     */
    public function test()
    {
        $templateStub = new TemplateTraitTestStub();

        # template
        $templateStub->setTemplateAttribute(' Test ');
        $this->assertEquals('test', $templateStub->template);
    }

}

class TemplateTraitTestStub extends Model
{
    use TemplateTrait;
}