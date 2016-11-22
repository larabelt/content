<?php

use Illuminate\Database\Eloquent\Model;
use Ohio\Content\Base\Behaviors\SeoTrait;
use Ohio\Content\Base\Validators\RouteValidator;

use Ohio\Core\Base\Testing\OhioTestCase;

class RouteValidatorTest extends OhioTestCase
{

    /**
     * @covers \Ohio\Content\Base\Validators\RouteValidator::routeIsUnique
     */
    public function test()
    {
        $validator = \Illuminate\Support\Facades\Validator::make([], ['url' => 'unique_route']);

        $routeValidator = new RouteValidator();

        $this->assertTrue($routeValidator->routeIsUnique('url', 'is-this-route-unique', [], $validator));
        $this->assertFalse($routeValidator->routeIsUnique('url', 'login', [], $validator));
    }

}