<?php

namespace Belt\Content\Commands;

use Belt\Content\Services\CompileService;
use Illuminate\Console\Command;

/**
 * Class CompileCommand
 * @package Belt\Content\Commands
 */
class CompileCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:compile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'compile pages';

    /**
     * @var CompileService
     */
    public $service;

    /**
     * @return CompileService
     */
    public function service()
    {
        return $this->service = $this->service ?: new CompileService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $service = $this->service();

        $service->pages();
    }

}