<?php

namespace StefanDoorn\SyliusAddressHouseNumberPlugin\Entity;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\AddressInterface;
use StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits\HouseNumber;
use Sylius\Component\Core\Model\Address as BaseAddress;

class Address extends BaseAddress implements AddressInterface
{
    use HouseNumber;
}
