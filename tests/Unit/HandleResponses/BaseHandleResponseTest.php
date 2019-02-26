<?php namespace Tests\Belt\Content\Unit\HandleResponses;

use Tests\Belt\Core;
use Belt\Content\Handle;
use Belt\Content\HandleResponses\BaseHandleResponse;

class BaseHandleResponseTest extends \Tests\Belt\Core\BeltTestCase
{

    /**
     * @covers \Belt\Content\HandleResponses\BaseHandleResponse::__construct
     * @covers \Belt\Content\HandleResponses\BaseHandleResponse::getStatusCode
     * @covers \Belt\Content\HandleResponses\BaseHandleResponse::getResponse
     */
    public function test()
    {
        Handle::unguard();

        $handle = new Handle();

        $response = new BaseHandleResponse($handle);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($handle, $response->handle);
        $this->assertNull($response->getResponse());

    }

}