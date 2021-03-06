<?php


namespace Lararole;


use Illuminate\Support\ServiceProvider;
use Lararole\Console\Commands\LararoleModelsGenerateCommand;
use Lararole\Console\Commands\LararoleModelMakeCommand;
use Lararole\Console\Commands\LararoleTraitsGenerateCommand;
use Lararole\Console\Commands\LararoleTraitMakeCommand;

class LararoleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/lararole.php' => config_path('lararole.php'),
        ], 'lararole-config');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->commands([
            LararoleModelMakeCommand::class,
            LararoleModelsGenerateCommand::class,
            LararoleTraitMakeCommand::class,
            LararoleTraitsGenerateCommand::class,
        ]);
    }
}