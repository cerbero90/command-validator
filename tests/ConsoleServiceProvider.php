<?php

namespace Cerbero\CommandValidator;

use Illuminate\Support\ServiceProvider;

/**
 * The console service provider.
 *
 */
class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(SampleCommand::class, JustValidationCommand::class);
        }
    }
}
