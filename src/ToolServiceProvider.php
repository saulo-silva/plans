<?php

namespace SauloSilva\Plans;

use SauloSilva\Plans\Policies\PlansPolicy;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use SauloSilva\Plans\Http\Middleware\Authorize;
use SauloSilva\Plans\Models\Plan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Artisan;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Plan::class => PlansPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'plans');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->registerSeedsFrom(__DIR__.'/../database/seeds');

        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            //
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        $this->registerPolicies();

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/plans')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register seeds.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerSeedsFrom($path)
    {
        foreach (glob("$path/*.php") as $filename)
        {
            include $filename;
            $classes = get_declared_classes();
            $class = end($classes);

            $command = Request::server('argv', null);
            if (is_array($command)) {
                $command = implode(' ', $command);
                if ($command == "artisan db:seed") {
                    Artisan::call('db:seed', ['--class' => $class]);
                }
            }

        }
    }
}
