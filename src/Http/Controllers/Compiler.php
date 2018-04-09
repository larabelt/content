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

    /**
     * @param HasSectionsInterface $owner
     * @param bool $force
     * @return mixed
     */
    public function compile(HasSectionsInterface $owner, $force = false)
    {

        if (env('APP_DEBUG') || $owner->getTemplateConfig('force_compile')) {
            $force = true;
        }

        if (!$force && Auth::user()) {
            try {
                $this->authorize('update', $owner);
                $force = true;
            } catch (\Exception $e) {

            }
        }

        if ($force) {
            $this->compiler()->clearCache($owner);
        }

        return $this->compiler()->getCached($owner);
    }

}