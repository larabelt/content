<?php namespace Tests\Belt\Content\Unit\HandleResponses;

use Tests\Belt\Core;
use Belt\Content\Handle;
use Belt\Content\Page;
use Belt\Content\HandleResponses\AliasHandleResponse;
use Illuminate\Support\Facades\Response;

class AliasHandleResponseTest extends \Tests\Belt\Core\BeltTestCase
{

    /**
     * @covers \Belt\Content\HandleResponses\AliasHandleResponse::getResponse
     */
    public function test()
    {


        # empty handleable
        $handle = factory(Handle::class)->make();
        $response = (new AliasHandleResponse($handle))->getResponse();
        $this->assertEquals(404, $response->getStatusCode());

        # active handleable w/macro
        $page = factory(Page::class)->make(['is_active' => true]);
        $handle->handleable = $page;
        $response = (new AliasHandleResponse($handle))->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        # inactive handleable w/macro
        $page = factory(Page::class)->make(['is_active' => false]);
        $handle->handleable = $page;
        $response = (new AliasHandleResponse($handle))->getResponse();
        $this->assertEquals(404, $response->getStatusCode());

        # active handleable wo/macro
        $stub = new AliasHandleResponseStub();
        $handle->handleable = $stub;
        $response = (new AliasHandleResponse($handle))->getResponse();
        $this->assertEquals(404, $response->getStatusCode());

        # active handleable w/failing macro
        Response::macro('foo', function ($stub) {
            throw new \Exception('foobar');
        });
        $response = (new AliasHandleResponse($handle))->getResponse();
        $this->assertEquals(404, $response->getStatusCode());

    }

}

class AliasHandleResponseStub
{
    public function getMorphClass()
    {
        return 'foo';
    }
}