<?php

use Mockery as m;

use Ohio\Core\Testing\OhioTestCase;
use Ohio\Content\Behaviors\Taggable;
use Ohio\Content\Tag;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class TaggableTest extends OhioTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Behaviors\Taggable::tags
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