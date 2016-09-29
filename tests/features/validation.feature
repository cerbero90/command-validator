Feature: Console command validation
  In order to make sure the input passed to console commands is valid
  As a developer
  I want to see validation errors in the terminal when the input is not valid

  Scenario: Validation fails
    Given I have a console command
    When I pass invalid input to the command
    Then I see validation errors in the terminal

  Scenario: Validation passes
    Given I have a console command
    When I pass valid input to the command
    Then I don't see validation errors in the terminal
