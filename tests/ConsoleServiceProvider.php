<?php

namespace Cerbero\CommandValidator;

use Illuminate\Support\Facades\App;
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
        if (App::runningInConsole()) {
            $this->commands(SampleCommand::class, JustValidationCommand::class);
        }
    }
}
