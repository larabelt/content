<?php

namespace Ohio\Content\Base\Commands;

use Ohio\Core\Base\Commands\PublishCommand as Command;

class PublishCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ohio-content:publish {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'publish assets for ohio content';

    protected $dirs = [
        'vendor/ohiocms/content/config' => 'config/ohio',
        'vendor/ohiocms/content/resources' => 'resources/ohio/content',
        'vendor/ohiocms/content/database/factories' => 'database/factories',
        'vendor/ohiocms/content/database/migrations' => 'database/migrations',
        'vendor/ohiocms/content/database/seeds' => 'database/seeds',
    ];

}