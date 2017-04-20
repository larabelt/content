<?php

namespace Belt\Content\Http\Controllers;

use Auth;
use Belt\Content\Behaviors\HasSectionsInterface;
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

    public function compile(HasSectionsInterface $owner)
    {
        $method = env('APP_DEBUG') ? 'compile' : 'cache';

        $force_compile = array_get($owner->getTemplateConfig(), 'force_compile', false);
        if ($force_compile) {
            $method = 'compile';
        }

        /**
         * @todo below does not work on "handled" routes
         */
        if ($method == 'cache' && Auth::user()) {
            try {
                $this->authorize('update', $owner);
                $method = 'compile';
            } catch (\Exception $e) {

            }
        }

        $compiled = $this->compiler()->$method($owner);

        return $compiled;
    }

}