<?php

use Illuminate\Console\Command;
use Cerbero\CommandValidator\ValidatesInput;

/**
 * Console command to test the input validator.
 *
 * @author    Andrea Marco Sartori
 */
class TestCommand extends Command
{
    use ValidatesInput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test {year} {--price=} {--country=}';

    /**
     * Retrieve the validation rules.
     *
     * @author    Andrea Marco Sartori
     * @return    array
     */
    protected function rules()
    {
        return [
            'year'    => 'integer|digits:4|min:2000',
            'price'   => 'required',
            'country' => 'in:Italy,Australia',
        ];
    }

    /**
     * Handle the command.
     *
     * @author    Andrea Marco Sartori
     * @return    void
     */
    public function handle()
    {
        $this->info('No validation errors.');
    }
}
