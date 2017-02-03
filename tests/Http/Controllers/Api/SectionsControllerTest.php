<?php

use Mockery as m;
use Ohio\Core\Testing;

use Ohio\Content\Section;
use Ohio\Content\Http\Requests\StoreSection;
use Ohio\Content\Http\Requests\PaginateSections;
use Ohio\Content\Http\Requests\UpdateSection;
use Ohio\Content\Http\Controllers\Api\SectionsController;
use Ohio\Core\Http\Exceptions\ApiNotFoundHttpException;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionsControllerTest extends Testing\OhioTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::__construct
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::get
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::show
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::destroy
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::update
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::store
     * @covers \Ohio\Content\Http\Controllers\Api\SectionsController::index
     */
    public function test()
    {
        $this->actAsSuper();

        $section1 = factory(Section::class)->make(['header' => 'section1']);

        $qbMock = $this->getPaginateQBMock(new PaginateSections(), [$section1]);

        $sectionRepository = m::mock(Section::class);
        $sectionRepository->shouldReceive('find')->with(1)->andReturn($section1);
        $sectionRepository->shouldReceive('find')->with(999)->andReturn(null);
        $sectionRepository->shouldReceive('create')->andReturn($section1);
        $sectionRepository->shouldReceive('query')->andReturn($qbMock);

        # construct
        $controller = new SectionsController($sectionRepository);
        $this->assertEquals($sectionRepository, $controller->sections);

        # get existing section
        $section = $controller->get(1);
        $this->assertEquals($section1->header, $section->header);

        # get section that doesn't exist
        try {
            $controller->get(999);
        } catch (\Exception $e) {
            $this->assertInstanceOf(ApiNotFoundHttpException::class, $e);
        }

        # show section
        $response = $controller->show(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData();
        $this->assertEquals($section1->header, $data->header);

        # destroy section
        $response = $controller->destroy(1);
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(204, $response->getStatusCode());

        # update section
        $response = $controller->update(new UpdateSection(), 1);
        $this->assertInstanceOf(JsonResponse::class, $response);

        # create section
        $response = $controller->store(new StoreSection([
            'sectionable_id' => null,
            'sectionable_type' => 'sections',
        ]));
        $this->assertInstanceOf(JsonResponse::class, $response);

        # index
        $response = $controller->index(new PaginateSections());
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($section1->header, $response->getData()->data[0]->header);

    }

}