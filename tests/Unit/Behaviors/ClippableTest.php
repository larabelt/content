<?php namespace Tests\Belt\Content\Unit\Behaviors;

use Mockery as m;
use Belt;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Behaviors\Clippable;
use Belt\Content\Lyst;
use Belt\Content\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class ClippableTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        parent::setUp();

        ClippableTestStub::unguard();

        app()['config']->set('belt.subtypes.clippableTestStub.test', [
            'resizes' => [
                'presets' => [
                    [100, 100],
                    [200, 200, 'resize'],
                    [300, 300, 'resize'],
                ]
            ]
        ]);
    }

    /**
     * @covers \Belt\Content\Behaviors\Clippable::attachments
     * @covers \Belt\Content\Behaviors\Clippable::getResizePresets
     * @covers \Belt\Content\Behaviors\Clippable::getImageAttribute
     * @covers \Belt\Content\Behaviors\Clippable::getImagesAttribute
     */
    public function test()
    {
        # attachments
        $morphMany = m::mock(Relation::class);
        $morphMany->shouldReceive('orderBy')->withArgs(['position']);
        $pageMock = m::mock(ClippableTestStub::class . '[morphMany]');
        $pageMock->shouldReceive('morphMany')->withArgs([Attachment::class, 'clippable'])->andReturn($morphMany);
        $pageMock->shouldReceive('attachments');
        $pageMock->attachments();

        # getResizePresets
        $clippable = new ClippableTestStub(['subtype' => 'test']);
        $this->assertEquals(config('belt.subtypes.clippableTestStub.test.resizes.presets'), $clippable->getResizePresets());

//        # purgeAttachments
//        $clippable = new ClippableTestStub();
//        $clippable->id = 1;
//        DB::shouldReceive('connection')->once()->andReturnSelf();
//        DB::shouldReceive('table')->once()->with('clippables')->andReturnSelf();
//        DB::shouldReceive('where')->once()->with('clippable_id', 1)->andReturnSelf();
//        DB::shouldReceive('where')->once()->with('clippable_type', 'clippableTestStub')->andReturnSelf();
//        DB::shouldReceive('delete')->once()->andReturnSelf();
//        $clippable->purgeAttachments();

//        # attachment
//        $this->assertInstanceOf(BelongsTo::class, $clippable->attachment());

        # getImageAttribute
        Attachment::unguard();
        $clippable = factory(Lyst::class)->make();
        $this->assertNull($clippable->getImageAttribute());
        $clippable->attachments = new \Illuminate\Support\Collection();
        $clippable->attachments->push(factory(Attachment::class)->make(['mimetype' => 'application/pdf']));
        $this->assertNull($clippable->getImageAttribute());
        $clippable->attachments->push(factory(Attachment::class)->make(['mimetype' => 'image/png']));
        $this->assertInstanceOf(Attachment::class, $clippable->getImageAttribute());

        # getImagesAttribute
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $clippable->getImagesAttribute());
        $this->assertGreaterThan(0, $clippable->attachments->count());
    }

    /**
     * @covers \Belt\Content\Behaviors\Clippable::attachAttachment
     */
    public function testAttachAttachment()
    {
        Attachment::unguard();

        # works
        $attachment = m::mock(Attachment::class . '[touch]', ['id' => 1]);
        $attachment->shouldReceive('touch')->andReturnSelf();

        $attachmentsRelation = m::mock(\Rutorika\Sortable\BelongsToSortedMany::class);
        $attachmentsRelation->shouldReceive('attach')->andReturnSelf();

        $list = m::mock(Lyst::class . '[attachments]');
        $list->attachments = new \Illuminate\Support\Collection();
        $list->shouldReceive('attachments')->andReturn($attachmentsRelation);

        $list->attachAttachment($attachment);

        # fails
        $attachment = m::mock(Attachment::class . '[touch]', ['id' => 1]);
        $attachment->shouldReceive('touch')->andReturnSelf();

        $attachmentsRelation = m::mock(\Rutorika\Sortable\BelongsToSortedMany::class);
        $attachmentsRelation->shouldReceive('attach')->andThrow(new \Exception());

        $list = m::mock(Lyst::class . '[attachments]');
        $list->attachments = new \Illuminate\Support\Collection();
        $list->shouldReceive('attachments')->andReturn($attachmentsRelation);

        $list->attachAttachment($attachment);
    }

}

class ClippableTestStub extends Model
{
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IncludesSubtypes;
    use Clippable;

    public function getMorphClass()
    {
        return 'clippableTestStub';
    }
}

class ClippableTestStub2 extends Model
{
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IncludesSubtypes;
    use Clippable;

    public function getMorphClass()
    {
        return 'clippableTestStub';
    }
}

class ClippableTestStub3 extends Model
{
    use Belt\Core\Behaviors\HasSortableTrait;
    use Belt\Core\Behaviors\IncludesSubtypes;
    use Clippable;

    public function getMorphClass()
    {
        return 'clippableTestStub';
    }
}