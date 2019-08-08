<?php

namespace App\Modules\Common\Providers;

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
        $this->loadTranslationsFrom(module_path('common', 'Resources/Lang', 'app'), 'common');
        $this->loadViewsFrom(module_path('common', 'Resources/Views', 'app'), 'common');
        $this->loadMigrationsFrom(module_path('common', 'Database/Migrations', 'app'), 'common');
        $this->loadConfigsFrom(module_path('common', 'Config', 'app'));
        $this->loadFactoriesFrom(module_path('common', 'Database/Factories', 'app'));
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
