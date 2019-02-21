<?php namespace Tests\Belt\Content\Unit\HandleResponses;

use Belt\Core\Tests;
use Belt\Content\Handle;
use Belt\Content\HandleResponses\NotFoundResponse;

class NotFoundResponseTest extends Tests\BeltTestCase
{

    /**
     * @covers \Belt\Content\HandleResponses\NotFoundResponse::getResponse
     */
    public function test()
    {
        $handle = factory(Handle::class)->make();
        $response = (new NotFoundResponse($handle))->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
    }

}