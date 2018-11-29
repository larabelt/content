<?php

namespace Belt\Content\Http\Controllers;

use Illuminate, Symfony;
use Belt\Content\HandleResponses\NotFoundResponse;
use Belt\Content\HandleResponses\HandleResponseInterface;
use Belt\Content\Handle;
use Illuminate\Http\Request;

trait HandleResponses
{

    /**
     * @param Request $request
     * @return Illuminate\Contracts\Routing\ResponseFactory|Symfony\Component\HttpFoundation\Response
     */
    public function getHandledResponse(Request $request)
    {
        $uri = $request->getRequestUri();
        //$uri = $request->server->get('REQUEST_URI');

        $url = Handle::normalizeUrl($uri);

        $handle = Handle::firstOrCreate(['url' => $url]);
        $handle->hits++;
        $handle->save();

        if ($handle && $handle->is_active) {

            $handleResponseClass = $handle->getSubtypeConfig('class');

            if (class_exists($handleResponseClass)) {

                /**
                 * @var HandleResponseInterface $handleResponse
                 */
                $handleResponse = new $handleResponseClass($handle);

                return $handleResponse->getResponse();
            }
        }

        return (new NotFoundResponse())->getResponse();
    }

}