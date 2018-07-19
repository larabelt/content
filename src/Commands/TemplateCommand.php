<?php

namespace Belt\Content\Commands;

use Belt\Core\Behaviors\IncludesSubtypesInterface;
use Belt\Core\Helpers\MorphHelper;
use Illuminate\Console\Command;

/**
 * Class TemplateCommand
 * @package Belt\Content\Commands
 */
class TemplateCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:template {action} {--class=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * @var MorphHelper
     */
    public $helper;

    /**
     * @return MorphHelper
     */
    public function helper()
    {
        return $this->helper = $this->helper ?: new MorphHelper();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');

        if ($action == 'reconcile-params') {

            $classes = explode(',', $this->option('class'));

            foreach ($classes as $class) {
                if (!class_exists($class)) {
                    $class = $this->helper()->type2Class($class);
                }
                if (in_array(IncludesSubtypesInterface::class, class_implements($class))) {
                    $items = $class::all();
                    foreach ($items as $item) {
                        $item->touch();
                    }
                }
            }
        }

    }

}