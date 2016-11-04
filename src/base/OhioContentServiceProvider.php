<?php

namespace Ohio\Content\Base;

use Ohio\Content;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider;

class OhioContentServiceProvider extends ServiceProvider
{

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/../page/Http/routes.php';
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(GateContract $gate, Router $router)
    {

        // set view paths
        $this->loadViewsFrom(resource_path('ohio/content/views'), 'ohio-content');

        // set backup view paths
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'ohio-content');

        $this->registerPolicies($gate);

        $this->commands(Content\Base\Commands\PublishCommand::class);
    }

    /**
     * Register the application's policies.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function registerPolicies(GateContract $gate)
    {
//        $gate->before(function ($user, $ability) {
//            if ($user->hasRole('SUPER')) {
//                return true;
//            }
//        });
//
//        foreach ($this->policies as $key => $value) {
//            $gate->policy($key, $value);
//        }
    }

}