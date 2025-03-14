<?php

namespace Softbengal\LaraInitializer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Softbengal\LaraInitializer\Helpers\EnvWriter;
use Illuminate\Support\Facades\Blade;

class LaraSetupFormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         try {
            \DB::connection()->getPDO();
         } catch (\Throwable $th) {
            EnvWriter::removeEnvValue('DB_HOST');
            EnvWriter::removeEnvValue('DB_PORT');
            EnvWriter::removeEnvValue('DB_DATABASE');
            EnvWriter::removeEnvValue('DB_USERNAME');
            EnvWriter::removeEnvValue('DB_PASSWORD');
            EnvWriter::removeEnvValue('DB_CONNECTION');
            EnvWriter::setEnvValue('DB_CONNECTION', 'sqlite');
         }

        $this->publishes([
            __DIR__.'/../config/config.php'=>config_path('larainitializer.php')
        ],'larainitializer-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views','larainitializer');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        Blade::component('input', \Softbengal\LaraInitializer\View\Components\Input::class);
    }
}
