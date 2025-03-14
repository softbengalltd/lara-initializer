<?php

namespace EngrShishir\Contactform;

use Illuminate\Support\ServiceProvider;
use EngrShishir\Contactform\Database\CustomDatabaseManager;
use Illuminate\Database\DatabaseManager as LaravelDatabaseManager;
use Illuminate\Support\Facades\DB;
use EngrShishir\Contactform\Helpers\EnvWriter;
use Illuminate\Support\Facades\Blade;

class ContactFormServiceProvider extends ServiceProvider
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
            __DIR__.'/../config/config.php'=>config_path('larasetupform.php')
        ],'contactform-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views','contactform');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        Blade::component('input', \EngrShishir\Contactform\View\Components\Input::class);
    }
}
