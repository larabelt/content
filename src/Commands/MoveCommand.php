<?php

namespace Belt\Content\Commands;

use Belt\Content\Services\MoveService;
use Illuminate\Console\Command;

/**
 * Class MoveCommand
 * @package Belt\Content\Commands
 */
class MoveCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:move {source} {target} {--limit=100} {--ids=} {--path=} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'move images';


    /**
     * @var MoveService
     */
    public $service;

    /**
     * @return MoveService
     */
    public function service()
    {
        return $this->service = $this->service ?: new MoveService(['console' => $this]);
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $service = $this->service();

        $service->run($this->argument('source'), $this->argument('target'), [
            'ids' => $this->option('ids'),
            'limit' => $this->option('limit'),
            'path' => $this->option('path'),
            'queue' => $this->option('queue'),
        ]);
    }

}