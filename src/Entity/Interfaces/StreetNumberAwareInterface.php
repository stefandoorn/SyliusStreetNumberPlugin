<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces;

interface StreetNumberAwareInterface
{
    public function getNumber(): string;

    public function setNumber(string $number): void;

    public function getAddition(): ?string;

    public function setAddition(string $addition): void;

    public function getStreetWithoutNumberAndAddition(): string;

    public function getNumberWithAddition(): string;
}
