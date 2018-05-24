<?php

use Illuminate\Database\Eloquent\Model;
use Belt\Content\Behaviors\IncludesSeo;

class IncludesSeoTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Behaviors\IncludesSeo::setMetaTitleAttribute
     * @covers \Belt\Content\Behaviors\IncludesSeo::setMetaKeywordsAttribute
     * @covers \Belt\Content\Behaviors\IncludesSeo::setMetaDescriptionAttribute
     * @covers \Belt\Content\Behaviors\IncludesSeo::getMetaTitleAttribute
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