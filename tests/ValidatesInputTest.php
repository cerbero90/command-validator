<?php

namespace Cerbero\CommandValidator;

use Orchestra\Testbench\TestCase;

/**
 * The ValidatesInput trait test.
 *
 */
class ValidatesInputTest extends TestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ConsoleServiceProvider::class,
        ];
    }

    /**
     * @test
     */
    public function showValidationErrors()
    {
        $errors = $this->getFormattedErrors();

        $this->artisan('sample 1 --foo=abc')
            ->expectsOutput($errors)
            ->assertExitCode(1);
    }

    /**
     * Retrieve the formatted validation errors
     *
     * @return string
     */
    protected function getFormattedErrors() : string
    {
        $expectedErrors = [
            'The year of birth must be 4 digits.',
            'The minimum allowed year of birth is 2000',
            'The foo may not be greater than 2 characters.',
        ];

        return PHP_EOL . PHP_EOL . implode(PHP_EOL, $expectedErrors) . PHP_EOL;
    }

    /**
     * @test
     */
    public function executeCommandIfValidationPasses()
    {
        $this->artisan('sample 2000 --foo=ab')
            ->expectsOutput('Success!')
            ->assertExitCode(0);
    }
}
