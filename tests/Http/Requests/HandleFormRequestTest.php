<?php

use Mockery as m;
use Belt\Core\Testing;
use Belt\Content\Handle;
use Belt\Content\HandleResponses\PermanentRedirectResponse;
use Belt\Content\Http\Requests\HandleFormRequest;

class HandleFormRequestTest extends Testing\BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Requests\HandleFormRequest::configs
     * @covers \Belt\Content\Http\Requests\HandleFormRequest::config
     * @covers \Belt\Content\Http\Requests\HandleFormRequest::messages
     * @covers \Belt\Content\Http\Requests\HandleFormRequest::all
     */
    public function test()
    {
        app()['config']->set('belt.subtypes.handles', [
            'default' => [
                'class' => PermanentRedirectResponse::class,
                'show_target' => true,
            ],
        ]);

        $request = new HandleFormRequest();

        # messages
        $this->assertNotEmpty($request->messages());

        # configs
        $this->assertNotEmpty($request->configs());

        # config
        $this->assertEquals(PermanentRedirectResponse::class, $request->config('class'));
        $this->assertTrue(is_array($request->config()));

        # getValidatorInstance
        $request = new HandleFormRequest(['url' => 'test']);
        $this->assertEquals('test', $request->get('url'));
        $this->assertEquals('/test', array_get($request->all(), 'url'));
    }

}