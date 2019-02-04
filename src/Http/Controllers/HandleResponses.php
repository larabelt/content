<?php

namespace Belt\Content\Http\Controllers;

use Illuminate, Symfony, Translate;
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
        //$uri = $request->server->get('REQUEST_URI');
        $uri = $request->getRequestUri();
        $uri = array_get(parse_url($uri), 'path');
        $uri = rtrim($uri, '/');

        $url = Handle::normalizeUrl($uri);

        $handle = Handle::where(['url' => $url])->first();

        if (Translate::isEnabled()) {
            if (!$handle || $handle->subtype == 'not-found') {
                $handle = null;
                foreach (Translate::getAvailableLocales() as $locale) {
                    $prefix = Handle::normalizeUrl($locale['code']);
                    //$prefix = sprintf('/%s', strtolower($locale['code']));
                    if (substr($url, 0, strlen($prefix)) == $prefix) {
                        $url = substr($uri, strlen($prefix));
                        $url = Handle::normalizeUrl($url);
                        break;
                    }
                }
            }
        }

        $handle = $handle ?: Handle::firstOrCreate(['url' => $url]);
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