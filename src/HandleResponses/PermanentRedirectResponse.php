<?php

namespace Belt\Content\HandleResponses;

class PermanentRedirectResponse extends TemporaryRedirectResponse
{
    public $statusCode = 301;
}