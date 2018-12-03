<?php

namespace Belt\Content\Commands;

use Belt\Content\Services\TranslateStringService;
use Illuminate\Console\Command;

/**
 * Class TranslatableStringCommand
 * @package Belt\Content\Commands
 */
class TranslatableStringCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:translatable_strings {action} {--locale=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * @var TranslateStringService
     */
    public $service;

    public function service()
    {
        return $this->service ?: $this->service = new TranslateStringService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        $locale = $this->option('locale');

        if ($locale && $action == 'build') {
            $this->service()->buildStorageFile($locale);
        }

    }

}