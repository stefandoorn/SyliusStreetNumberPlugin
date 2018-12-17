<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces;

interface StreetNumberAwareInterface
{
    public function getStreetNumber(): ?string;

    public function setStreetNumber(string $number): void;

    public function getStreetNumberAddition(): ?string;

    public function setStreetNumberAddition(string $addition): void;

    public function getStreetNumberWithAddition(): string;

    public function getStreetWithoutStreetNumber(): string;

    public function getStreetWithoutStreetNumberAndWithoutAddition(): string;

    public function getStreetWithoutStreetNumberAddition(): string;
}
