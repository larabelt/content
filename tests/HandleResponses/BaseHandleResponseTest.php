<?php

namespace Belt\Content\HandleResponses;

use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Handle;

class BaseHandleResponseTest extends Testing\BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

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