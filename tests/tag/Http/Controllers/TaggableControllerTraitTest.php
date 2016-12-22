<?php

use Mockery as m;
use Ohio\Core\Base\Testing;

use Ohio\Content\Page\Page;
use Ohio\Content\Tag\Tag;
use Ohio\Content\Tag\Http\Requests\CreateRequest;
use Ohio\Content\Tag\Http\Requests\PaginateRequest;
use Ohio\Content\Tag\Http\Requests\UpdateRequest;
use Ohio\Content\Tag\Http\Controllers\ApiController;
use Ohio\Core\Base\Http\Exceptions\ApiNotFoundHttpException;

use Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait;
use Ohio\Content\Page\Http\Controllers\Api\TagsController;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaggableControllerTraitTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::tagRepo
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::getTag
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::getTaggable
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::index
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::store
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::show
     * @covers \Ohio\Content\Tag\Http\Controllers\TaggableControllerTrait::destroy
     */
    public function test()
    {

        $page = new Page();
        $page->id = 1;
        $page->name = 'page';

        $tag1 = new Tag();
        $tag1->id = 1;
        $tag1->name = 'tag 1';

        $qbMock = $this->getPaginateQBMock(new PaginateRequest(), [$tag1]);

        $tagRepository = m::mock(Tag::class);
        $tagRepository->shouldReceive('query')->andReturn($qbMock);

        $qbMock->shouldReceive('where')->with('tags.id', 1)->andReturn($qbMock);
        $qbMock->shouldReceive('tagged')->once()->with('pages', 1);
        $qbMock->shouldReceive('first')->times(2)->andReturn($tag1);

        # tagRepo
        $controller = new TagsController();
        $this->assertNull($controller->tagRepo);
        $controller->tagRepo();
        $this->assertInstanceOf(Tag::class, $controller->tagRepo);
        $controller->tagRepo = $tagRepository;

        # getTag
        $tag = $controller->getTag(1);
        $this->assertEquals($tag1->name, $tag->name);
        $tag = $controller->getTag(1, $page);
        $this->assertEquals($tag1->name, $tag->name);

        # getTaggable
    }

}