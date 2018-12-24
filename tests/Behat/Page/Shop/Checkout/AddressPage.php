<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusStreetNumberPlugin\Behat\Page\Shop\Checkout;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Mink\Session;
use StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\AddressInterface as PluginAddressInterface;
use Sylius\Component\Core\Factory\AddressFactoryInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Symfony\Component\Routing\RouterInterface;
use Webmozart\Assert\Assert;

final class AddressPage extends \Sylius\Behat\Page\Shop\Checkout\AddressPage implements AddressPageInterface
{
    /** @var AddressFactoryInterface */
    private $addressFactory;

    public function __construct(
        Session $session,
        array $parameters,
        RouterInterface $router,
        AddressFactoryInterface $addressFactory
    ) {
        parent::__construct($session, $parameters, $router, $addressFactory);

        $this->addressFactory = $addressFactory;
    }

    public function noValidationMessageFor($element): bool
    {
        $foundElement = $this->getFieldElement($element);
        if (null === $foundElement) {
            throw new ElementNotFoundException(
                $this->getSession(),
                'Validation message',
                'css',
                '.sylius-validation-error'
            );
        }

        return null === $foundElement->find('css', '.sylius-validation-error');
    }

    /**
     * {@inheritdoc}
     */
    public function specifyShippingAddress(AddressInterface $shippingAddress)
    {
        $this->specifyAddress($shippingAddress, self::TYPE_SHIPPING);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyBillingAddress(AddressInterface $billingAddress)
    {
        $this->specifyAddress($billingAddress, self::TYPE_BILLING);
    }

    public function getPreFilledShippingAddress(): AddressInterface
    {
        return $this->getPreFilledAddress(self::TYPE_SHIPPING);
    }

    public function getPreFilledBillingAddress(): AddressInterface
    {
        return $this->getPreFilledAddress(self::TYPE_BILLING);
    }

    protected function getDefinedElements(): array
    {
        return array_merge(
            parent::getDefinedElements(),
            [
                'billing_number' => '#sylius_checkout_address_billingAddress_number',
                'billing_addition' => '#sylius_checkout_address_billingAddress_addition',
                'shipping_number' => '#sylius_checkout_address_shippingAddress_number',
                'shipping_addition' => '#sylius_checkout_address_shippingAddress_addition',
            ]
        );
    }

    private function specifyAddress(AddressInterface $address, string $type): void
    {
        /** @var PluginAddressInterface $address */
        $this->assertAddressType($type);

        $this->getElement(sprintf('%s_first_name', $type))->setValue($address->getFirstName());
        $this->getElement(sprintf('%s_last_name', $type))->setValue($address->getLastName());
        $this->getElement(sprintf('%s_street', $type))->setValue($address->getStreet());
        $this->getElement(sprintf('%s_number', $type))->setValue($address->getNumber());
        $this->getElement(sprintf('%s_addition', $type))->setValue($address->getAddition());
        $this->getElement(sprintf('%s_country', $type))->selectOption($address->getCountryCode() ?: 'Select');
        $this->getElement(sprintf('%s_city', $type))->setValue($address->getCity());
        $this->getElement(sprintf('%s_postcode', $type))->setValue($address->getPostcode());

        if (null !== $address->getProvinceName()) {
            $this->waitForElement(5, sprintf('%s_province', $type));
            $this->getElement(sprintf('%s_province', $type))->setValue($address->getProvinceName());
        }
        if (null !== $address->getProvinceCode()) {
            $this->waitForElement(5, sprintf('%s_country_province', $type));
            $this->getElement(sprintf('%s_country_province', $type))->selectOption($address->getProvinceCode());
        }
    }

    private function getPreFilledAddress(string $type): AddressInterface
    {
        $this->assertAddressType($type);

        /** @var PluginAddressInterface $address */
        $address = $this->addressFactory->createNew();

        $address->setFirstName($this->getElement(sprintf('%s_first_name', $type))->getValue());
        $address->setLastName($this->getElement(sprintf('%s_last_name', $type))->getValue());
        $address->setStreet($this->getElement(sprintf('%s_street', $type))->getValue());
        $address->setNumber($this->getElement(sprintf('%s_number', $type))->getValue());
        $address->setAddition($this->getElement(sprintf('%s_addition', $type))->getValue());
        $address->setCountryCode($this->getElement(sprintf('%s_country', $type))->getValue());
        $address->setCity($this->getElement(sprintf('%s_city', $type))->getValue());
        $address->setPostcode($this->getElement(sprintf('%s_postcode', $type))->getValue());
        $this->waitForElement(5, sprintf('%s_province', $type));

        try {
            $address->setProvinceName($this->getElement(sprintf('%s_province', $type))->getValue());
        } catch (ElementNotFoundException $exception) {
            $address->setProvinceCode($this->getElement(sprintf('%s_country_province', $type))->getValue());
        }

        return $address;
    }

    /**
     * @param string $element
     *
     * @return NodeElement|null
     *
     * @throws ElementNotFoundException
     */
    private function getFieldElement($element)
    {
        $element = $this->getElement($element);
        while (null !== $element && !$element->hasClass('field')) {
            $element = $element->getParent();
        }

        return $element;
    }

    private function waitForElement($timeout, $elementName): bool
    {
        return $this->getDocument()->waitFor(
            $timeout,
            function () use ($elementName) {
                return $this->hasElement($elementName);
            }
        );
    }

    private function assertAddressType(string $type): void
    {
        $availableTypes = [self::TYPE_BILLING, self::TYPE_SHIPPING];

        Assert::oneOf(
            $type,
            $availableTypes,
            sprintf(
                'There are only two available types %s, %s. %s given',
                self::TYPE_BILLING,
                self::TYPE_SHIPPING,
                $type
            )
        );
    }
}
