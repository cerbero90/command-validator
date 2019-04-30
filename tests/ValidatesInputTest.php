<?php

namespace Cerbero\CommandValidator;

use Orchestra\Testbench\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * The ValidatesInput trait test.
 *
 */
class ValidatesInputTest extends TestCase
{
    /**
     * The console command tester.
     *
     * @var \Symfony\Component\Console\Tester\CommandTester
     */
    protected $commandTester;

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
        $this->setUpCommandTester();

        $statusCode = $this->commandTester->execute([
            'year' => 0,
            '--foo' => 'abc',
        ]);

        $this->assertSame(1, $statusCode);
        $this->assertOutputContains('The year of birth must be 4 digits.');
        $this->assertOutputContains('The minimum allowed year of birth is 2000');
        $this->assertOutputContains('The foo may not be greater than 2 characters.');
    }

    /**
     * Set the tests up
     *
     * @return void
     */
    protected function setUpCommandTester()
    {
        $command = new SampleCommand;
        $command->setLaravel($this->app);

        $this->commandTester = new CommandTester($command);
    }

    /**
     * Assert that the given message is present in output
     *
     * @param string $message
     * @return void
     */
    protected function assertOutputContains(string $message)
    {
        $output = $this->commandTester->getDisplay();

        $this->assertTrue(strpos($output, $message) !== false);
    }

    /**
     * @test
     */
    public function executeCommandIfValidationPasses()
    {
        $this->setUpCommandTester();

        $statusCode = $this->commandTester->execute([
            'year' => 2000,
            '--foo' => 'ab',
        ]);

        $this->assertSame(0, $statusCode);
        $this->assertOutputContains('Success!');
    }
}
