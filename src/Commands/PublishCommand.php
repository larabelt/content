<?php

namespace Belt\Content\Commands;

use Belt\Core\Commands\PublishCommand as Command;

/**
 * Class PublishCommand
 * @package Belt\Content\Commands
 */
class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:publish {action=publish} {--include=} {--exclude=} {--force} {--config} {--prune}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for belt content';

    /**
     * @var array
     */
    protected $dirs = [
        'vendor/larabelt/content/config' => 'config/belt',
        'vendor/larabelt/content/database/factories' => 'database/factories',
        'vendor/larabelt/content/database/migrations' => 'database/migrations',
        'vendor/larabelt/content/database/seeds' => 'database/seeds',
        'vendor/larabelt/content/docs' => 'resources/docs/raw',
    ];

}