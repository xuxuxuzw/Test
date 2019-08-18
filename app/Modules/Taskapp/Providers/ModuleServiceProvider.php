<?php

namespace App\Modules\Taskapp\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(module_path('taskapp', 'Resources/Lang', 'app'), 'taskapp');
        $this->loadViewsFrom(module_path('taskapp', 'Resources/Views', 'app'), 'taskapp');
        $this->loadMigrationsFrom(module_path('taskapp', 'Database/Migrations', 'app'), 'taskapp');
        $this->loadConfigsFrom(module_path('taskapp', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('taskapp', 'Database/Factories', 'app'));
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }
}
