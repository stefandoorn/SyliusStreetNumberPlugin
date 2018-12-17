<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

trait StreetNumber
{
    /**
     * @var string|null
     */
    private $streetNumber;

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $number): void
    {
        $this->streetNumber = $number;
    }

    public function getStreetWithoutStreetNumber(): string
    {
        return trim(rtrim($this->getStreet() ?? '', $this->getStreetNumber() ?? ''));
    }
}
