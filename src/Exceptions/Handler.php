<?php

namespace Belt\Content\Exceptions;

use Exception, Illuminate, Symfony;
use Belt\Content\HandleResponses\NotFoundResponse;
use Belt\Content\HandleResponses\HandleResponseInterface;
use Belt\Core\Exceptions\Handler as BaseHandler;
use Belt\Content\Handle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 * @package Belt\Content\Exceptions
 */
class Handler extends BaseHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof NotFoundHttpException) {

            $url = Handle::normalizeUrl($request->path());

            $handle = Handle::firstOrCreate(['url' => $url]);
            $handle->hits++;
            $handle->save();

            if ($handle && $handle->is_active) {

                $handleResponseClass = $handle->config('class');

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

        return parent::render($request, $exception);
    }

}