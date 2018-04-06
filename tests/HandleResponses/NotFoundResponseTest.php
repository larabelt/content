<?php

use Belt\Core\Testing;
use Belt\Content\Handle;
use Belt\Content\HandleResponses\NotFoundResponse;

class NotFoundResponseTest extends Testing\BeltTestCase
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