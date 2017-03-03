<?php

use Mockery as m;
use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Behaviors\Sectionable;
use Illuminate\Database\Eloquent\Model;

class SectionableTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Behaviors\Sectionable::getSectionName
     */
    public function test()
    {

        $sectionable = new SectionableTestStub();
        $sectionable->name = 'Bar';
        $sectionable->slug = 'bar';

        $this->assertNotEmpty($sectionable->getSectionName());
    }

}

class SectionableTestStub extends Model
{
    private $morphClass = 'foo';

    use Sectionable;
}