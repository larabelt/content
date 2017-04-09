<?php

namespace Belt\Content\Commands;

use Belt\Content\Services\CompileService;
use Belt\Core\Helpers\MorphHelper;
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
    protected $signature = 'belt-content:compile {classes} {--ids=}';

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

        $classes = $this->argument('classes');

        $ids = $this->option('ids');

        foreach (explode(',', $classes) as $class) {
            $object = (new MorphHelper())->type2Class($class    );

            $qb = $object::query();

            if ($ids) {
                $qb->whereIn('id', explode(',', $ids));
            }

            $items = $qb->get();

            foreach ($items as $item) {
                $service->compile($item);
            }
        }


    }

}