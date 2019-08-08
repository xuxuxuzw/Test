<?php

namespace App\Modules\Index\Providers;

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
        $this->loadTranslationsFrom(module_path('index', 'Resources/Lang', 'app'), 'index');
        $this->loadViewsFrom(module_path('index', 'Resources/Views', 'app'), 'index');
        $this->loadMigrationsFrom(module_path('index', 'Database/Migrations', 'app'), 'index');
        $this->loadConfigsFrom(module_path('index', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('index', 'Database/Factories', 'app'));
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
