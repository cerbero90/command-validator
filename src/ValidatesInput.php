<?php

namespace Cerbero\CommandValidator;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Validate input submitted to console commands.
 *
 * @author    Andrea Marco Sartori
 */
trait ValidatesInput
{
    /**
     * @author    Andrea Marco Sartori
     * @var        Illuminate\Validation\Validator    $validator    Input validator.
     */
    protected $validator;

    /**
     * Execute the console command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->validator()->passes()) {
            return parent::execute($input, $output);
        }

        return $this->error($this->getFormattedErrors());
    }

    /**
     * Retrieve the input validator.
     *
     * @author    Andrea Marco Sartori
     * @return    Illuminate\Validation\Validator
     */
    protected function validator()
    {
        $input = array_merge($this->option(), $this->argument());

        return $this->validator = $this->validator ?: $this->laravel['validator']->make(
            $input, $this->rules(), $this->messages(), $this->attributes()
        );
    }

    /**
     * Retrieve and format the validation errors.
     *
     * @author    Andrea Marco Sartori
     * @return    string
     */
    protected function getFormattedErrors()
    {
        $errors = implode("\n", $this->validator()->errors()->all());

        return "\n\n{$errors}\n";
    }

    /**
     * Retrieve the validation rules.
     *
     * @author    Andrea Marco Sartori
     * @return    array
     */
    abstract protected function rules();

    /**
     * Retrieve the custom error messages.
     *
     * @author    Andrea Marco Sartori
     * @return    array
     */
    protected function messages()
    {
        return [];
    }

    /**
     * Retrieve the custom attributes for error messages.
     *
     * @author    Andrea Marco Sartori
     * @return    array
     */
    protected function attributes()
    {
        return [];
    }
}
