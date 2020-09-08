<?php

namespace Cerbero\CommandValidator;

use Illuminate\Console\Command;

/**
 * The command to test validation only without overrides.
 *
 */
class JustValidationCommand extends Command
{
    use ValidatesInput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'just-validation {year} {--foo=}';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Success!');
    }

    /**
     * Retrieve the rules to validate data against
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'year' => 'digits:4|integer|min:2000',
            'foo' => 'string|max:2',
        ];
    }
}
