<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusStreetNumberPlugin\Behat\Page\Shop\Checkout;

use Behat\Mink\Exception\ElementNotFoundException;

final class AddressPage extends \Sylius\Behat\Page\Shop\Checkout\AddressPage implements AddressPageInterface
{
    public function noValidationMessageFor($element): bool
    {
        $foundElement = $this->getFieldElement($element);
        if (null === $foundElement) {
            throw new ElementNotFoundException($this->getSession(), 'Validation message', 'css', '.sylius-validation-error');
        }

        return null === $foundElement->find('css', '.sylius-validation-error');
    }

    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'billing_number' => '#sylius_checkout_address_billingAddress_number',
            'billing_addition' => '#sylius_checkout_address_billingAddress_addition',
            'shipping_number' => '#sylius_checkout_address_shippingAddress_number',
            'shipping_addition' => '#sylius_checkout_address_shippingAddress_addition',
        ]);
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
}
