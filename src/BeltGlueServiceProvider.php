<?php

namespace Belt\Content;

use Belt;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class BeltContentServiceProvider
 * @package Belt\Content
 */
class BeltContentServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Belt\Content\Term::class => Belt\Content\Policies\TermPolicy::class,
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/../routes/admin.php';
        include __DIR__ . '/../routes/api.php';
        include __DIR__ . '/../routes/web.php';

        # beltable values for global belt command
        $this->app['belt']->addPackage('content', ['dir' => __DIR__ . '/..']);
        $this->app['belt']->publish('belt-content:publish');
        $this->app['belt']->seeders('BeltContentSeeder');
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GateContract $gate, Router $router)
    {
        //observers
        Term::observe(Belt\Content\Observers\TermObserver::class);

        // set backup view paths
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'belt-content');

        // set backup translation paths
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'belt-content');

        // policies
        $this->registerPolicies($gate);

        // morphMap
        Relation::morphMap([
            'terms' => Belt\Content\Term::class,
        ]);

        // commands
        $this->commands(Belt\Content\Commands\PublishCommand::class);

        // route model binding
        $router->model('term', Belt\Content\Term::class, function ($value) {
            return Belt\Content\Term::sluggish($value)->firstOrFail();
        });
    }

    /**
     * Register the application's policies.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function registerPolicies(GateContract $gate)
    {
        foreach ($this->policies as $key => $value) {
            $gate->policy($key, $value);
        }
    }

}