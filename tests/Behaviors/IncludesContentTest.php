<?php

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Behaviors\IncludesContent;

class IncludesContentTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Ohio\Content\Behaviors\IncludesContent::setIsActiveAttribute
     * @covers \Ohio\Content\Behaviors\IncludesContent::setIntroAttribute
     * @covers \Ohio\Content\Behaviors\IncludesContent::setBodyAttribute
     */
    public function test()
    {
        $contentStub = new IncludesContentTestStub();

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

class IncludesContentTestStub extends Model
{
    use IncludesContent;
}