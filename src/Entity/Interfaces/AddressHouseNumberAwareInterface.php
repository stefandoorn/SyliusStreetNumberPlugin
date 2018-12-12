<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusAddressHouseNumberPlugin\Entity\Interfaces;

interface AddressHouseNumberAwareInterface
{
    public function getHouseNumber(): ?string;

    public function setHouseNumber(string $houseNumber): void;

    public function getStreetWithoutStreetNumber(): string;
}
