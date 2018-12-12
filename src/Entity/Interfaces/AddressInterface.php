<?php

namespace StefanDoorn\SyliusAddressHouseNumberBundle\Entity\Interfaces;

use Sylius\Component\Core\Model\AddressInterface as BaseAddressInterface;

interface AddressInterface extends BaseAddressInterface, AddressHouseNumberAwareInterface
{

}
