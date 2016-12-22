<?php

use Mockery as m;

use Ohio\Core\Base\Testing\OhioTestCase;
use Ohio\Content\Base\Behaviors\TaggableTrait;
use Ohio\Content\Tag\Tag;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class TaggableTraitTest extends OhioTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Base\Behaviors\TaggableTrait::tags
     */
    public function test()
    {
        # tags
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderby')->withArgs(['delta']);
        $pageMock = m::mock(TaggableTraitTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphMany')->withArgs([Tag::class, 'taggable'])->andReturn($morphMany);
        $pageMock->shouldReceive('tags');
        $pageMock->tags();
    }

}

class TaggableTraitTestStub extends Model
{
    use TaggableTrait;
}