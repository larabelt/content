<?php

namespace Belt\Content\HandleResponses;

use Response;
use Belt\Content\Handle;

class AliasHandleResponse extends BaseHandleResponse implements HandleResponseInterface
{
    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        $response = null;

        if (!$this->handleable) {
            return (new NotFoundResponse())->getResponse();
        }

        $macro = $this->handleable->getMorphClass();
        if (Response::hasMacro($macro)) {
            $response = response()->$macro($this->handle->handleable);
        }

        return $response;
    }

}