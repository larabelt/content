<?php

namespace Belt\Content\Validators;

use Belt\Content\Handle;
use Request, Route;
use Illuminate\Validation\Validator;

/**
 * Class RouteValidator
 * @package Belt\Content\Validators
 */
class RouteValidator
{

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param Validator $validator
     * @return bool
     */
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