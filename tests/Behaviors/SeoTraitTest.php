<?php

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Behaviors\SeoTrait;

class SeoTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Behaviors\SeoTrait::setMetaTitleAttribute
     * @covers \Ohio\Content\Behaviors\SeoTrait::setMetaKeywordsAttribute
     * @covers \Ohio\Content\Behaviors\SeoTrait::setMetaDescriptionAttribute
     * @covers \Ohio\Content\Behaviors\SeoTrait::getMetaTitleAttribute
     */
    public function test()
    {
        $seoStub = new SeoTraitTestStub();

        # meta title
        $seoStub->setAttribute('name', 'Test');
        $this->assertEquals('Test', $seoStub->meta_title);
        $seoStub->meta_title = ' Meta Test ';
        $this->assertEquals('Meta Test', $seoStub->meta_title);

        # meta description
        $seoStub->meta_description = ' Test ';
        $this->assertEquals('Test', $seoStub->meta_description);

        # meta keywords
        $seoStub->meta_keywords = ' Test ';
        $this->assertEquals('Test', $seoStub->meta_keywords);
    }

}

class SeoTraitTestStub extends Model
{
    use SeoTrait;
}