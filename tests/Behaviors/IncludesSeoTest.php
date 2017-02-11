<?php

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Behaviors\IncludesSeo;

class IncludesSeoTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Behaviors\IncludesSeo::setMetaTitleAttribute
     * @covers \Ohio\Content\Behaviors\IncludesSeo::setMetaKeywordsAttribute
     * @covers \Ohio\Content\Behaviors\IncludesSeo::setMetaDescriptionAttribute
     * @covers \Ohio\Content\Behaviors\IncludesSeo::getMetaTitleAttribute
     */
    public function test()
    {
        $seoStub = new IncludesSeoTestStub();

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

class IncludesSeoTestStub extends Model
{
    use IncludesSeo;
}