<?php

namespace Belt\Content\Http\Controllers;

use Belt\Content\Services\CompileService;

trait Compiler
{

    /**
     * @var CompileService
     */
    public $compiler;

    /**
     * @return CompileService
     */
    public function compiler()
    {
        return $this->compiler = $this->compiler ?: new CompileService();
    }

}