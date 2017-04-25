<?php

namespace Belt\Content\HandleResponses;

use Redirect;

class TemporaryRedirectResponse extends BaseHandleResponse implements HandleResponseInterface
{

    public $statusCode = 302;

    /**
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function getResponse()
    {
        $response = null;

        $target = $this->handleable->default_url ?? $this->handle->target;

        if ($target && $target != $this->handle->url) {
            $response = Redirect::to($target, $this->getStatusCode());
        }

        return $response;
    }

}