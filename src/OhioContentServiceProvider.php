<?php

namespace Ohio\Content;

use Ohio, Validator, View;
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
    protected $policies = [
        Ohio\Content\Block::class => Ohio\Content\Policies\BlockPolicy::class,
        Ohio\Content\Handle::class => Ohio\Content\Policies\HandlePolicy::class,
        Ohio\Content\Page::class => Ohio\Content\Policies\PagePolicy::class,
        Ohio\Content\Section::class => Ohio\Content\Policies\SectionPolicy::class,
        Ohio\Content\Tag::class => Ohio\Content\Policies\TagPolicy::class,
        Ohio\Content\Tout::class => Ohio\Content\Policies\ToutPolicy::class,
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
            'blocks' => Ohio\Content\Block::class,
            'handles' => Ohio\Content\Handle::class,
            'pages' => Ohio\Content\Page::class,
            'sections' => Ohio\Content\Section::class,
            'tags' => Ohio\Content\Tag::class,
            'touts' => Ohio\Content\Tout::class,
        ]);

        // commands
        $this->commands(Ohio\Content\Commands\CompileCommand::class);
        $this->commands(Ohio\Content\Commands\PublishCommand::class);

        Validator::extend('unique_route', Ohio\Content\Validators\RouteValidator::class . '@routeIsUnique');
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