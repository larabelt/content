<?php

namespace Belt\Content\Commands;

use Belt\Core\Commands\PublishCommand as Command;

class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for belt content';

    protected $dirs = [
        'vendor/larabelt/content/config' => 'config/belt',
        //'vendor/larabelt/content/resources' => 'resources/belt/content',
        'vendor/larabelt/content/database/factories' => 'database/factories',
        'vendor/larabelt/content/database/migrations' => 'database/migrations',
        'vendor/larabelt/content/database/seeds' => 'database/seeds',
    ];

}