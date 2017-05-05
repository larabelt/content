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
            $route = $routes->match($request);

            /**
             * If we make it this far, the route exists. However, ignore
             * catch-all routes.
             */
            if ($route->uri() == '{any?}') {
                $validates = true;
            }

        } catch (\Exception $e) {
            // route doesn't exist
            $validates = true;
        }

        return $validates;
    }

}