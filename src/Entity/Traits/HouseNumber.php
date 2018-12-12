<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusAddressHouseNumberPlugin\Entity\Traits;

trait HouseNumber
{
    /**
     * @var string|null
     */
    private $houseNumber;

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function getStreetWithoutStreetNumber(): string
    {
        return trim(rtrim($this->getStreet() ?? '', $this->getStreetNumber() ?? ''));
    }
}
