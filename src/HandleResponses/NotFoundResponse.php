<?php

namespace Belt\Content\HandleResponses;

class NotFoundResponse extends BaseHandleResponse implements HandleResponseInterface
{

    public $statusCode = 404;

    /**
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function getResponse()
    {
        return response()->view('belt-content::pages.web.404-not-found', [], 404);
    }

}