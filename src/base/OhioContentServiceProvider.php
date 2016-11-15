<?php

namespace Ohio\Content\Base;

use Validator;

use Ohio\Content;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Routing\Router;
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
        include __DIR__ . '/Http/routes.php';
        include __DIR__ . '/../block/Http/routes.php';
        include __DIR__ . '/../handle/Http/routes.php';
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

        // policies
        $this->registerPolicies($gate);

        // morphMap
        Relation::morphMap([
            'content/page' => Content\Page\Page::class,
        ]);

        // commands
        $this->commands(Content\Base\Commands\PublishCommand::class);

        Validator::extend('unique_route', \Ohio\Content\Base\Validators\RouteValidator::class . '@routeIsUnique');
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