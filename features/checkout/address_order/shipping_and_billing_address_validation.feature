@house_number_checkout
Feature: Order addressing validation
    In order to avoid making mistakes when addressing an order
    As an Customer
    I want to be prevented from adding it without specifying required fields

    Background:
        Given the store operates on a single channel in "United States"
        And the store ships everywhere for free
        And the store has a product "PHP T-Shirt" priced at "$19.99"
        And I am a logged in customer

    @ui
    Scenario: Address an order without number
        Given I have product "PHP T-Shirt" in the cart
        And I am at the checkout addressing step
        When I do not specify any shipping address information
        And I try to complete the addressing step
        Then I should be notified that the street number in shipping details is required
        And I should not be notified that the street number addition in shipping details is required

    @ui
    Scenario: Address an order's billing address without number
        Given I have product "PHP T-Shirt" in the cart
        And I am at the checkout addressing step
        When I specify the shipping address as "Ankh Morpork", "Frost Alley", "90210", "United States" for "Jon Snow"
        And I do not specify any billing address information
        And I try to complete the addressing step
        Then I should be notified that the street number in billing details is required
        And I should not be notified that the street number addition in billing details is required
