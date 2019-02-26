<?php namespace Tests\Belt\Content\Unit\Http\Controllers;

use Mockery as m;
use Tests\Belt\Core;
use Belt\Content\Http\Controllers\CatchAllController;

class CatchAllControllerTest extends \Tests\Belt\Core\BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Http\Controllers\CatchAllController::web
     */
    public function test()
    {
        $request = new \Illuminate\Http\Request(['foo' => 'bar']);

        $controller = m::mock(CatchAllController::class . '[getHandledResponse]');
        $controller->shouldReceive('getHandledResponse')->once()->with($request);

        $controller->web($request);
    }

}