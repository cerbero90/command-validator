<?php

declare(strict_types=1);

namespace Cerbero\CommandValidator;

use Illuminate\Support\ServiceProvider;

/**
 * The service provider to register the testing console commands.
 */
final class CommandValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(DefaultErrorsCommand::class, CustomErrorsCommand::class);
        }
    }
}
