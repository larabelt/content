<?php namespace Tests\Belt\Content\Unit\Exceptions;

use Mockery as m;
use Belt\Core\Tests\BeltTestCase;
use Belt\Content\Exceptions\Handler;
use Belt\Content\Handle;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandlerTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Exceptions\Handler::render
     */
    public function test()
    {
        $this->refreshDB();

        $handler = new Handler(app());

        # default render
        $this->assertInstanceOf(Illuminate\Http\Response::class, $handler->render(new Request(), new \Exception()));

        # 404 render
        $handle = Handle::first();
        $request = m::mock(Request::class);
        $request->shouldReceive('getRequestUri')->once()->andReturn($handle->url);
        $this->assertInstanceOf(Illuminate\Http\Response::class, $handler->render($request, new NotFoundHttpException()));
    }

}
