<?php

use Symfony\Component\Console\Command\Command;

it('shows default validation errors')
    ->artisan('default-errors', ['year' => 0, '--foo' => 'abc'])
    ->assertExitCode(Command::FAILURE)
    ->expectsOutputToContain('The year field must be 4 digits.')
    ->expectsOutputToContain('The year field must be at least 2000.')
    ->expectsOutputToContain('The foo field must be true or false.');

it('shows custom validation errors')
    ->artisan('custom-errors', ['year' => 0, '--foo' => 'abc'])
    ->assertExitCode(Command::FAILURE)
    ->expectsOutputToContain('The year of birth field must be 4 digits.')
    ->expectsOutputToContain('The minimum allowed year of birth is 2000')
    ->expectsOutputToContain('The foo field must be true or false.');

it('does not show validation errors if the input is valid')
    ->artisan('custom-errors', ['year' => 2000, '--foo' => true])
    ->assertSuccessful()
    ->expectsOutputToContain('success!');
