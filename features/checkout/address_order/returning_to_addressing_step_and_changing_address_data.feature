@house_number_checkout
Feature: Returning to the addressing step and changing address data
    In order to correct my address data
    As a Visitor
    I want to be able to return to the addressing step and see street, number & addition being split properly

    Background:
        Given the store operates on a single channel in "United States"
        And the store has a product "Apollo 11 T-Shirt" priced at "$49.99"
        And the store ships everywhere for free

    @ui
    Scenario: Going back to addressing step to see street, number & addition are split properly
        Given I have product "Apollo 11 T-Shirt" in the cart
        And I am at the checkout addressing step
        When I specify the email as "jon.snow@example.com"
        And I specify the shipping address as "Ankh Morpork", "Frost Alley 12 a", "90210", "United States" for "Jon Snow"
        And I complete the addressing step
        And I decide to change my address
        Then address "Jon Snow", "Frost Alley 12 a", "90210", "Ankh Morpork", "United States" should be filled as shipping address
        And address "Jon Snow", "Frost Alley 12 a", "90210", "Ankh Morpork", "United States" should be filled as billing address
