<?php

declare(strict_types=1);

namespace Cerbero\CommandValidator;

use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * The trait to validate the input of console commands.
 */
trait ValidatesInput
{
    /**
     * The validator.
     */
    protected Validator $validator;

    /**
     * Retrieve the validation rules.
     *
     * @return array<string, mixed>
     */
    abstract protected function rules(): array;

    /**
     * Execute the console command.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($this->validator()->fails()) {
            $this->printErrors($this->formatErrors());

            return static::FAILURE;
        }

        return parent::execute($input, $output);
    }

    /**
     * Retrieve the validator.
     */
    protected function validator(): Validator
    {
        /** @phpstan-ignore-next-line */
        return $this->validator ??= $this->laravel['validator']->make(
            $this->getDataToValidate(),
            $this->rules(),
            $this->messages(),
            $this->attributes(),
        );
    }

    /**
     * Retrieve the data to validate.
     *
     * @return array<string, mixed>
     */
    protected function getDataToValidate(): array
    {
        return array_filter([...$this->argument(), ...$this->option()], fn(mixed $value) => $value !== null);
    }

    /**
     * Print the given errors to the console.
     */
    protected function printErrors(string $errors): void
    {
        $this->output->block($errors, style: 'fg=white;bg=red', prefix: '  ', padding: true);
    }

    /**
     * Format the validation errors.
     */
    protected function formatErrors(): string
    {
        return implode(PHP_EOL, $this->validator()->errors()->all());
    }

    /**
     * Retrieve the custom error messages.
     *
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [];
    }

    /**
     * Retrieve the custom error attributes.
     *
     * @return array<string, string>
     */
    protected function attributes(): array
    {
        return [];
    }
}
