<?php

use Illuminate\Database\Eloquent\Model;
use Belt\Content\Behaviors\IncludesContent;

class IncludesContentTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Belt\Content\Behaviors\IncludesContent::setIsActiveAttribute
     * @covers \Belt\Content\Behaviors\IncludesContent::setIntroAttribute
     * @covers \Belt\Content\Behaviors\IncludesContent::setBodyAttribute
     */
    public function test()
    {
        $contentStub = new IncludesContentTestStub();

        # is active
        $contentStub->is_active = 'true';
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