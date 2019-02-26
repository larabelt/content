<?php namespace Tests\Belt\Content\Unit\HandleResponses;

use Tests\Belt\Core;
use Belt\Content\Handle;
use Belt\Content\Page;
use Belt\Content\HandleResponses\TemporaryRedirectResponse;

class TemporaryRedirectResponseTest extends \Tests\Belt\Core\BeltTestCase
{

    /**
     * @covers \Belt\Content\HandleResponses\TemporaryRedirectResponse::getResponse
     */
    public function test()
    {
        $handle = factory(Handle::class)->make(['target' => 'foo']);
        $page = factory(Page::class)->make(['is_active' => true]);
        $handle->handleable = $page;
        $response = (new TemporaryRedirectResponse($handle))->getResponse();
        $this->assertEquals(302, $response->getStatusCode());
    }

}