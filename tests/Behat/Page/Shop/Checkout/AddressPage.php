<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusStreetNumberPlugin\Behat\Page\Shop\Checkout;

final class AddressPage extends \Sylius\Behat\Page\Shop\Checkout\AddressPage implements AddressPageInterface
{
    protected function getDefinedElements(): array
    {
        return array_merge(parent::getDefinedElements(), [
            'billing_number' => '#sylius_checkout_address_billingAddress_number',
            'billing_addition' => '#sylius_checkout_address_billingAddress_addition',
            'shipping_number' => '#sylius_checkout_address_shippingAddress_number',
            'shipping_addition' => '#sylius_checkout_address_shippingAddress_addition',
        ]);
    }
}