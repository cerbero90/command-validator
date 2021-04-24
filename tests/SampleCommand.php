<?php

namespace Cerbero\CommandValidator;

use Illuminate\Console\Command;

/**
 * The sample command.
 *
 */
class SampleCommand extends Command
{
    use ValidatesInput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sample {year} {--foo=}';

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
            'foo' => 'boolean',
        ];
    }

    /**
     * Retrieve the custom error messages
     *
     * @return array
     */
    protected function messages(): array
    {
        return [
            'min' => 'The minimum allowed :attribute is :min',
        ];
    }

    /**
     * Retrieve the custom attribute names for error messages
     *
     * @return array
     */
    protected function attributes(): array
    {
        return [
            'year' => 'year of birth'
        ];
    }
}
