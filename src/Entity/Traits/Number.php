<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

trait Number
{
    /**
     * @var string|null
     */
    private $number;

    public function getNumber(): string
    {
        return $this->number ?? '';
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }
}
