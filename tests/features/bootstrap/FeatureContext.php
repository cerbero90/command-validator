<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements SnippetAcceptingContext
{
    /**
     * @author    Andrea Marco Sartori
     * @var        Symfony\Component\Console\Tester\CommandTester    $tester    Console command tester.
     */
    protected $tester;

    /**
     * @author    Andrea Marco Sartori
     * @var        array    $errors    Expected validation errors.
     */
    protected $errors = [
        "The year must be an integer.",
        "The year must be 4 digits.",
        "The year must be at least 2000.",
        "The price field is required.",
    ];

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I have a console command
     */
    public function iHaveAConsoleCommand()
    {
        ($command = new TestCommand)->setLaravel(app());

        $this->tester = new CommandTester($command);
    }

    /**
     * @When I pass invalid input to the command
     */
    public function iPassInvalidInputToTheCommand()
    {
        $this->tester->execute([
            'year'  => 'wrong',
        ]);
    }

    /**
     * @Then I see validation errors in the terminal
     */
    public function iSeeValidationErrorsInTheTerminal()
    {
        foreach ($this->errors as $error) {
            $this->checkMessageInConsole($error);
        }
    }

    /**
     * Check whether the given message is present in the terminal.
     *
     * @author    Andrea Marco Sartori
     * @param    string    $message
     * @return    void
     */
    protected function checkMessageInConsole($message)
    {
        if (strpos($display = $this->tester->getDisplay(), $message) === false) {
            throw new Exception("Unable to find '$message' in:\n$display");
        }
    }

    /**
     * @When I pass valid input to the command
     */
    public function iPassValidInputToTheCommand()
    {
        $this->tester->execute([
            'year'  => 2016,
            '--price'  => 22,
        ]);
    }

    /**
     * @Then I don't see validation errors in the terminal
     */
    public function iDonTSeeValidationErrorsInTheTerminal()
    {
        $this->checkMessageInConsole('No validation errors.');
    }
}
