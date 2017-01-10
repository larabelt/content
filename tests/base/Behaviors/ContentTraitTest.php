<?php

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Base\Behaviors\ContentTrait;

class ContentTraitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Base\Behaviors\ContentTrait::setIsActiveAttribute
     * @covers \Ohio\Content\Base\Behaviors\ContentTrait::setIntroAttribute
     * @covers \Ohio\Content\Base\Behaviors\ContentTrait::setBodyAttribute
     */
    public function test()
    {
        $contentStub = new ContentTraitTestStub();

        # is active
        $contentStub->is_active = ' true!!! ';
        $this->assertEquals(true, $contentStub->is_active);

        # intro
        $contentStub->intro = ' Test ';
        $this->assertEquals('Test', $contentStub->intro);

        # body
        $contentStub->body = ' Test ';
        $this->assertEquals('Test', $contentStub->body);
    }

}

class ContentTraitTestStub extends Model
{
    use ContentTrait;
}