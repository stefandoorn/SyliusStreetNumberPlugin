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

    public function getStreetNumber(): string
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
        return trim(sprintf('%s %s', $this->getStreetNumber(), $this->getStreetNumberAddition() ?? ''));
    }

    public function getStreetWithoutStreetNumber(): string
    {
        $input = $this->getStreetNumber() ?? '';
        $street = $this->getStreet();

        return trim(substr($street, 0, strlen($street) - strlen($input)));
    }

    public function getStreetWithoutStreetNumberAndWithoutAddition(): string
    {
        $input = $this->getStreetNumberWithAddition();
        $street = $this->getStreet();

        return trim(substr($street, 0, strlen($street) - strlen($input)));
    }

    public function getStreetWithoutStreetNumberAddition(): string
    {
        $input = $this->getStreetNumberAddition();
        $street = $this->getStreet();

        return trim(substr($street, 0, strlen($street) - strlen($input)));
    }
}
