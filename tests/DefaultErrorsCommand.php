<?php

declare(strict_types=1);

namespace Cerbero\CommandValidator;

use Illuminate\Console\Command;

/**
 * A testing command with default validation errors.
 */
final class DefaultErrorsCommand extends Command
{
    use ValidatesInput;

    /**
     * The signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default-errors {year} {--foo=}';

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
}
