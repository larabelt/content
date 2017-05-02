<?php

namespace Belt\Content\Exceptions;

use Exception, Illuminate, Symfony;
use Belt\Core\Exceptions\Handler as BaseHandler;
use Belt\Content\Http\Controllers\HandleResponses;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 * @package Belt\Content\Exceptions
 */
class Handler extends BaseHandler
{

    use HandleResponses;

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
            return $this->getHandledResponse($request);
        }

        return parent::render($request, $exception);
    }

}