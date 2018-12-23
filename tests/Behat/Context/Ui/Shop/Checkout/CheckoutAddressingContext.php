<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusStreetNumberPlugin\Behat\Context\Ui\Shop\Checkout;

use Behat\Behat\Context\Context;
use Tests\StefanDoorn\SyliusStreetNumberPlugin\Behat\Page\Shop\Checkout\AddressPageInterface;
use Sylius\Behat\Page\Shop\Checkout\SelectShippingPageInterface;
use Sylius\Behat\Service\SharedStorageInterface;
use Sylius\Component\Addressing\Comparator\AddressComparatorInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Webmozart\Assert\Assert;

final class CheckoutAddressingContext implements Context
{
    /** @var SharedStorageInterface */
    private $sharedStorage;

    /** @var AddressPageInterface */
    private $addressPage;

    /** @var FactoryInterface */
    private $addressFactory;

    /** @var AddressComparatorInterface */
    private $addressComparator;

    /** @var SelectShippingPageInterface */
    private $selectShippingPage;

    public function __construct(
        SharedStorageInterface $sharedStorage,
        AddressPageInterface $addressPage,
        FactoryInterface $addressFactory,
        AddressComparatorInterface $addressComparator,
        SelectShippingPageInterface $selectShippingPage
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->addressPage = $addressPage;
        $this->addressFactory = $addressFactory;
        $this->addressComparator = $addressComparator;
        $this->selectShippingPage = $selectShippingPage;
    }

    /**
     * @Then /^I should(?:| also) be notified that the street number in (shipping|billing) details is required$/
     */
    public function iShouldBeNotifiedThatTheAndTheInShippingDetailsAreRequired($type)
    {
        $element = 'number';

        $this->assertElementValidationMessage($type, $element, sprintf('Please fill in a street %s.', $element));
    }

    /**
     * @param string $type
     * @param string $element
     * @param string $expectedMessage
     *
     * @throws \InvalidArgumentException
     */
    private function assertElementValidationMessage($type, $element, $expectedMessage)
    {
        $element = sprintf('%s_%s', $type, str_replace(' ', '_', $element));
        Assert::true($this->addressPage->checkValidationMessageFor($element, $expectedMessage));
    }
}
