<?php

namespace Belt\Content;

use Belt, Laravel, Validator;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
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
        Belt\Content\Attachment::class => Belt\Content\Policies\AttachmentPolicy::class,
        Belt\Content\Block::class => Belt\Content\Policies\BlockPolicy::class,
        Belt\Content\Handle::class => Belt\Content\Policies\HandlePolicy::class,
        Belt\Content\Lyst::class => Belt\Content\Policies\ListPolicy::class,
        Belt\Content\Page::class => Belt\Content\Policies\PagePolicy::class,
        Belt\Content\Post::class => Belt\Content\Policies\PostPolicy::class,
        Belt\Content\Section::class => Belt\Content\Policies\SectionPolicy::class,
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
        include __DIR__ . '/../routes/handleables.php';
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
        Belt\Content\Term::observe(Belt\Content\Observers\TermObserver::class);

        // set backup view paths
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'belt-content');

        // set backup translation paths
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'belt-content');

        // policies
        $this->registerPolicies($gate);

        // morphMap
        Relation::morphMap([
            'attachments' => Belt\Content\Attachment::class,
            'attachment_resizes' => Belt\Content\Resize::class,
            'blocks' => Belt\Content\Block::class,
            'handles' => Belt\Content\Handle::class,
            'lists' => Belt\Content\Lyst::class,
            'list_items' => Belt\Content\ListItem::class,
            'favorites' => Belt\Content\Favorite::class,
            'pages' => Belt\Content\Page::class,
            'posts' => Belt\Content\Post::class,
            'sections' => Belt\Content\Section::class,
            'terms' => Belt\Content\Term::class,

            /**
             * @todo find why to get this out of here
             */
            'custom' => Belt\Content\Section::class,
        ]);

        // commands
        $this->commands(Belt\Content\Commands\FakerCommand::class);
        $this->commands(Belt\Content\Commands\MoveCommand::class);
        $this->commands(Belt\Content\Commands\ResizeCommand::class);
        $this->commands(Belt\Content\Commands\CompileCommand::class);
        $this->commands(Belt\Content\Commands\PublishCommand::class);
        $this->commands(Belt\Content\Commands\SubtypeCommand::class);

        // route model binding
        $router->model('attachment', Belt\Content\Attachment::class);
        $router->model('favorite', Belt\Content\Favorite::class);
        $router->model('handle', Belt\Content\Handle::class);
        $router->model('list', Belt\Content\Lyst::class, function ($value) {
            return Belt\Content\Lyst::sluggish($value)->firstOrFail();
        });
        $router->bind('page', function ($value) {
            $column = is_numeric($value) ? 'id' : 'slug';
            return Belt\Content\Page::where($column, $value)->first();
        });
        $router->bind('post', function ($value) {
            $column = is_numeric($value) ? 'id' : 'slug';
            return Belt\Content\Post::where($column, $value)->first();
        });
        $router->model('resize', Belt\Content\Resize::class);
        $router->bind('section', function ($value) {
            return Belt\Content\Section::find($value);
        });
        $router->model('term', Belt\Content\Term::class, function ($value) {
            return Belt\Content\Term::sluggish($value)->firstOrFail();
        });

        // validators
        Validator::extend('alt_url', Belt\Content\Validators\AltUrlValidator::class . '@altUrl');
        Validator::extend('unique_route', Belt\Content\Validators\RouteValidator::class . '@routeIsUnique');

        // blade directives
        Blade::directive('block', function ($expression) {
            list($slug, $field) = Belt\Core\Helpers\StrHelper::strToArguments($expression, 2);
            $block = Block::where('slug', $slug)->first();
            return $block ? ($field ? $block->$field : $block->body) : '';
        });

        // engines
        $this->app->register(Laravel\Scout\ScoutServiceProvider::class);
        $this->app->register(Belt\Content\Search\Mock\MockEngineServiceProvider::class);

        // additional providers
        $this->app->register(Belt\Content\Services\Cloudinary\CloudinaryServiceProvider::class);

        // access map for window config
        Belt\Core\Services\AccessService::put('*', 'attachments');
        Belt\Core\Services\AccessService::put('*', 'blocks');
        Belt\Core\Services\AccessService::put('*', 'handles');
        Belt\Core\Services\AccessService::put('*', 'favorites');
        Belt\Core\Services\AccessService::put('*', 'pages');
        Belt\Core\Services\AccessService::put('*', 'posts');
        Belt\Core\Services\AccessService::put('*', 'sections');
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