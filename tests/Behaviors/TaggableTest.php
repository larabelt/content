<?php

use Mockery as m;

use Belt\Core\Testing\BeltTestCase;
use Belt\Content\Behaviors\Taggable;
use Belt\Content\Tag;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class TaggableTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Behaviors\Taggable::tags
     */
    public function test()
    {
        # tags
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderby')->withArgs(['delta']);
        $pageMock = m::mock(TaggableTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphMany')->withArgs([Tag::class, 'taggable'])->andReturn($morphMany);
        $pageMock->shouldReceive('tags');
        $pageMock->tags();
    }

}

class TaggableTestStub extends Model
{
    use Taggable;
}