<?php

namespace Cerbero\CommandValidator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * The trait to validate console commands input.
 *
 */
trait ValidatesInput
{
    /**
     * The command input validator.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected $validator;

    /**
     * Retrieve the rules to validate data against
     *
     * @return array
     */
    abstract protected function rules(): array;

    /**
     * Execute the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return mixed
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->validator()->fails()) {
            throw new InvalidArgumentException($this->formatErrors());
        }

        return parent::execute($input, $output);
    }

    /**
     * Retrieve the command input validator
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(): ValidatorContract
    {
        if (isset($this->validator)) {
            return $this->validator;
        }

        return $this->validator = Validator::make(
            $this->getDataToValidate(),
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );
    }

    /**
     * Retrieve the data to validate
     *
     * @return array
     */
    protected function getDataToValidate(): array
    {
        $data = array_merge($this->argument(), $this->option());

        return array_filter($data, function ($value) {
            return $value !== null;
        });
    }

    /**
     * Format the validation errors
     *
     * @return string
     */
    protected function formatErrors(): string
    {
        return implode(PHP_EOL, $this->validator()->errors()->all());
    }

    /**
     * Retrieve the custom error messages
     *
     * @return array
     */
    protected function messages(): array
    {
        return [];
    }

    /**
     * Retrieve the custom attribute names for error messages
     *
     * @return array
     */
    protected function attributes(): array
    {
        return [];
    }
}
