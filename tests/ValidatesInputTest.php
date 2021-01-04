<?php

namespace Cerbero\CommandValidator;

use Orchestra\Testbench\TestCase;
use Symfony\Component\Console\Exception\InvalidArgumentException;
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
    public function showValidationErrorsWithCustomMessagesAndAttributes()
    {
        $this->setUpCommandTester();

        $errors = [
            'The year of birth must be 4 digits.',
            'The minimum allowed year of birth is 2000',
            'The foo may not be greater than 2 characters.',
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(implode(PHP_EOL, $errors));

        $this->commandTester->execute([
            'year' => 0,
            '--foo' => 'abc',
        ]);
    }

    /**
     * Set the tests up
     *
     * @return void
     */
    protected function setUpCommandTester()
    {
        $command = new SampleCommand();
        $command->setLaravel($this->app);

        $this->commandTester = new CommandTester($command);
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
    public function showValidationErrors()
    {
        $command = new JustValidationCommand();
        $command->setLaravel($this->app);
        $commandTester = new CommandTester($command);

        $errors = [
            'The year must be 4 digits.',
            'The year must be at least 2000.',
            'The foo may not be greater than 2 characters.',
        ];

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(implode(PHP_EOL, $errors));

        $commandTester->execute([
            'year' => 0,
            '--foo' => 'abc',
        ]);
    }
}
