<?php

namespace Belt\Content\Commands;

use Morph, Translate;
use Belt\Content\Handle;
use Belt\Core\Commands\TranslateCommand as BaseCommand;

/**
 * Class TranslateCommand
 * @package Belt\Content\Commands
 */
class TranslateCommand extends BaseCommand
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'belt-content:translate {action} {--limit=1} {--type=} {--id=} {--locale=} {--attribute=} {--debug} {--queue} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');

        if ($action == 'handles') {
            $this->handles();
        }

    }

    public function handles()
    {
        Handle::unguard();

        foreach ($this->types() as $type) {

            $limit = $this->option('limit');

            $qb = Morph::type2QB($type);

            if ($ids = $this->ids()) {
                $limit = count($ids);
                $qb->whereIn('id', $ids);
            }

            $count = 1;
            foreach ($qb->get() as $item) {

                foreach ($this->locales() as $locale) {
                    $handle = $item->handles->where('locale', $locale)->first();
                    if (!$handle) {
                        $url = $item->slug;
                        if (Translate::isAvailableLocale($locale)) {
                            $url = Translate::translate($item->name, $locale);
                        }
                        $handle = $item->handles()->create([
                            'locale' => $locale,
                            'subtype' => 'alias',
                            'is_active' => true,
                            'url' => str_slug($url),
                        ]);
                        if ($this->option('debug')) {
                            $this->info("new handle: $handle->url");
                        }
                    }
                }

                if ($count++ >= $limit) {
                    break;
                }
            }
        }
    }

}