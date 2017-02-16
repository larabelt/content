<?php

use Illuminate\Database\Eloquent\Model;
use Belt\Content\Behaviors\IncludesSeo;
use Belt\Content\Validators\RouteValidator;

use Belt\Core\Testing\BeltTestCase;

class RouteValidatorTest extends BeltTestCase
{

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

}