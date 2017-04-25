<?php

namespace Belt\Content\HandleResponses;

use Belt\Content\Behaviors\HandleableInterface;
use Belt\Content\Handle;

class BaseHandleResponse
{

    /**
     * HTTP Status Code
     *
     * @var int
     */
    public $statusCode = 200;

    /**
     * @var Handle
     */
    public $handle;

    /**
     * @var HandleableInterface
     */
    public $handleable;

    /**
     * BaseHandleResponse constructor.
     * @param Handle $handle
     */
    public function __construct(Handle $handle = null)
    {
        $handle = $handle ?? new Handle();

        $this->handle = $handle;

        $this->handleable = $handle->handleable;
    }

    /**
     * HTTP Status Code
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function getResponse()
    {

    }

}