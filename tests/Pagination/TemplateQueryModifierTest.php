<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Core\Http\Requests\PaginateRequest;
use Belt\Content\Pagination\TemplateQueryModifier;
use Illuminate\Database\Eloquent\Builder;

class TemplateQueryModifierTest extends Testing\BeltTestCase
{

    use Testing\CommonMocks;

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Pagination\TemplateQueryModifier::modify
     */
    public function test()
    {
        # modify
        $qb = m::mock(Builder::class);
        $qb->shouldReceive('where')->once()->withArgs(['test.template', true]);
        $request = new TemplateQueryModifierTestPaginateRequestStub(['template' => true]);
        $modifer = new TemplateQueryModifier($qb, $request);
        $modifer->modify($qb, $request);

    }

}

class TemplateQueryModifierTestPaginateRequestStub extends PaginateRequest {
    /**
     * @return string
     */
    public function morphClass()
    {
        return 'test';
    }
}