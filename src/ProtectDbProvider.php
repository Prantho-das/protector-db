<?php

namespace Pranthokumar\ProtectDb;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Pranthokumar\ProtectDb\App\Console\Commands\ProtectMyDbCommand;
use Pranthokumar\ProtectDb\App\Facades\ProtectDbFacade;

class ProtectDbProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

        $this->mergeConfigFrom(
            __DIR__ . '/config/protect-db.php', 'protect-db'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerRoutes();
        $this->registerPublishing();
        $this->registerViews();
        $this->registerFacade();
        $this->registerCollections();
        $this->registerCommands();
    }

    protected function registerRoutes()
    {
        Route::group([
            'prefix' => config('protect-db.route-prefix'),
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        });
    }

    public function provides()
    {
        return ['protectdb'];
    }

    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/protect-db.php' => config_path('protect-db.php'),
            ], 'config');
        }
    }

    protected function registerCommands()
    {
        $this->commands([
            ProtectMyDbCommand::class,
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);

            if (config('protect-db.backup')) {
                $schedule->command('protect-db:protect');
                if (config('protect-db.time') == 'weakly') {
                    $schedule->weekly();
                } elseif (config('protect-db.time') == 'monthly') {
                    $schedule->monthly();
                } elseif (config('protect-db.time') == 'daily') {
                    $schedule->daily();
                } elseif (config('protect-db.time') == 'hourly') {
                    $schedule->hourly();
                }

            }
        });

    }
    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__ . '/views', 'protect-db');
    }

    protected function registerFacade()
    {
        $this->app->bind('protectdb', function () {
            return new ProtectDbFacade();
        });
    }

    protected function registerCollections()
    {
        Collection::macro('paginate', function ($perPage = 10, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}