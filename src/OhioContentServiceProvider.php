<?php

namespace Ohio\Content;

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
        include __DIR__ . '/../routes/admin.php';
        include __DIR__ . '/../routes/api.php';
        include __DIR__ . '/../routes/web.php';
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
            'blocks' => Content\Block::class,
            'handles' => Content\Handle::class,
            'pages' => Content\Page::class,
            'tags' => Content\Tag::class,
        ]);

        // commands
        $this->commands(Content\Commands\PublishCommand::class);

        Validator::extend('unique_route', \Ohio\Content\Validators\RouteValidator::class . '@routeIsUnique');
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