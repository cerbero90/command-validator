<?php

declare(strict_types=1);

namespace Cerbero\CommandValidator;

use Illuminate\Console\Command;

/**
 * A testing command with custom validation errors.
 */
final class CustomErrorsCommand extends Command
{
    use ValidatesInput;

    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom-errors {year} {--foo=}';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('success!');

        return self::SUCCESS;
    }

    /**
     * Retrieve the validation rules.
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'year' => 'digits:4|integer|min:2000',
            'foo' => 'boolean',
        ];
    }

    /**
     * Retrieve the custom error messages.
     *
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'min' => 'The minimum allowed :attribute is :min',
        ];
    }

    /**
     * Retrieve the custom error attributes.
     *
     * @return array<string, string>
     */
    protected function attributes(): array
    {
        return [
            'year' => 'year of birth',
        ];
    }
}
