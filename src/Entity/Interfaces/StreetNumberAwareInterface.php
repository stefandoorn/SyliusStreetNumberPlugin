<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces;

interface StreetNumberAwareInterface
{
    public function getStreetNumber(): ?string;

    public function setStreetNumber(string $number): void;

    public function getStreetWithoutStreetNumber(): string;
}
