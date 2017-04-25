<?php

namespace Belt\Content\HandleResponses;

interface HandleResponseInterface
{
    public function getStatusCode();
    public function getResponse();
}