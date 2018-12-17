<?php

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces;

use Sylius\Component\Core\Model\AddressInterface as BaseAddressInterface;

interface AddressInterface extends BaseAddressInterface, StreetNumberAwareInterface
{

}
