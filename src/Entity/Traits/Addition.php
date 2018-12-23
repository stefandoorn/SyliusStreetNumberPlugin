<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

trait Addition
{
    /**
     * @var string|null
     */
    private $addition;

    public function getAddition(): ?string
    {
        return $this->addition;
    }

    public function setAddition(?string $addition): void
    {
        $this->addition = $addition;
    }
}
