<?php

namespace Belt\Content\Exceptions;

use Exception, Illuminate, Symfony;
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
            $handle = Handle::where('url', $request->path())->first();
            if ($handle) {
                $method = $handle->handleable_type;
                return response()->$method($handle->handleable);
            }
        }

        return parent::render($request, $exception);
    }

}