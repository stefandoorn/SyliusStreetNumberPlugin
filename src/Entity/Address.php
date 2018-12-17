<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\AddressInterface;
use StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits\StreetNumberAddition;
use Sylius\Component\Core\Model\Address as BaseAddress;

class Address extends BaseAddress implements AddressInterface
{
    use StreetNumberAddition;
}
