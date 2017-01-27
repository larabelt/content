<?php

namespace Ohio\Content\Base\Validators;

use Ohio\Content\Handle\Handle;
use Request, Route;
use Illuminate\Validation\Validator;

class RouteValidator
{

    public function routeIsUnique($attribute, $value, $parameters, Validator $validator)
    {
        $validator->setFallbackMessages(
            array_merge($validator->fallbackMessages, [
                    'unique_route' => 'this route already exists'
            ])
        );

        $validates = false;

        $value = Handle::normalizeUrl($value);

        try {
            $routes = Route::getRoutes();
            $request = Request::create($value);
            $routes->match($request);
            // route exists
        } catch (\Exception $e) {
            // route doesn't exist
            $validates = true;
        }

        return $validates;
    }

}