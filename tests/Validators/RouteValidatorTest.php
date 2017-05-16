<?php

use Mockery as m;
use Belt\Content\Validators\RouteValidator;
use Belt\Core\Testing\BeltTestCase;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Routing\Route;

class RouteValidatorTest extends BeltTestCase
{

    public function tearDown()
    {
        m::close();
    }

    /**
     * @covers \Belt\Content\Validators\RouteValidator::routeIsUnique
     */
    public function test()
    {
        $validator = \Illuminate\Support\Facades\Validator::make([], ['url' => 'unique_route']);

        $routeValidator = new RouteValidator();

        $this->assertTrue($routeValidator->routeIsUnique('url', 'is-this-route-unique', [], $validator));
        $this->assertFalse($routeValidator->routeIsUnique('url', 'login', [], $validator));
    }

    /**
     * @covers \Belt\Content\Validators\RouteValidator::routeIsUnique
     */
    public function test2()
    {
        $validator = \Illuminate\Support\Facades\Validator::make([], ['url' => 'unique_route']);

        $routeValidator = new RouteValidator();

        $route = m::mock(Route::class);
        $route->shouldReceive('uri')->andReturn('{any?}');

        $collection = m::mock(RouteCollection::class);
        $collection->shouldReceive('match')->andReturn($route);

        RouteFacade::shouldReceive('getRoutes')->andReturn($collection);

        $this->assertTrue($routeValidator->routeIsUnique('url', 'catchall-eligible-uri', [], $validator));

    }

}