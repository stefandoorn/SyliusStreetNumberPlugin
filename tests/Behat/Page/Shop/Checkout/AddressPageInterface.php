<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusStreetNumberPlugin\Behat\Page\Shop\Checkout;

interface AddressPageInterface extends \Sylius\Behat\Page\Shop\Checkout\AddressPageInterface
{
    public function noValidationMessageFor($element): bool;
}
