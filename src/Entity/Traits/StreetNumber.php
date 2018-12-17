<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

trait StreetNumber
{
    /**
     * @var string|null
     */
    private $streetNumber;

    /**
     * @var string|null
     */
    private $streetNumberAddition;

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber ?? '';
    }

    public function setStreetNumber(string $number): void
    {
        $this->streetNumber = $number;
    }

    public function getStreetNumberAddition(): ?string
    {
        return $this->streetNumberAddition;
    }

    public function setStreetNumberAddition(string $addition): void
    {
        $this->streetNumberAddition = $addition;
    }

    public function getStreetNumberWithAddition(): string
    {
        return $this->getStreetNumber() ?? '' . ' ' . $this->getStreetNumberAddition() ?? '';
    }

    public function getStreetWithoutStreetNumber(): string
    {
        return trim(rtrim($this->getStreet() ?? '', $this->getStreetNumber() ?? ''));
    }

    public function getStreetWithoutStreetNumberAndWithoutAddition(): string
    {
        return trim(rtrim($this->getStreet() ?? '', $this->getStreetNumberWithAddition() ?? ''));
    }

    public function getStreetWithoutStreetNumberAddition(): string
    {
        return trim(rtrim($this->getStreet() ?? '', $this->getStreetNumberAddition() ?? ''));
    }
}
