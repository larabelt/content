<?php

namespace Belt\Content\Commands;

use Riimu;
use Belt\Content\Services\ElasticService;
use Illuminate\Console\Command;

/**
 * Class CompileCommand
 * @package Belt\Content\Commands
 */
class ElasticCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:elastic {action} {--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * @var ElasticService
     */
    public $service;

    /**
     * @return ElasticService
     */
    public function service()
    {
        return $this->service = $this->service ?: new ElasticService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');

        if ($action == 'get-settings') {
            $this->service()->getSettings();
        }

        if ($action == 'get-mappings') {
            $this->service()->getMappings();
        }

        if ($action == 'put-mappings') {
            $this->service()->putMappings();
        }

        if ($action == 'delete-index') {
            $this->service()->deleteIndex();
        }

        if ($action == 'create-index') {
            $this->service()->createIndex();
        }

        if ($action == 'import') {
            $this->service()->import($this->option('type'));
        }

    }


}