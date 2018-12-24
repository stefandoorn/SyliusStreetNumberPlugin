<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

use StefanDoorn\SyliusStreetNumberPlugin\Helper\StripString;

trait StreetNumberAddition
{
    use Number;
    use Addition;

    public function getNumberWithAddition(): string
    {
        return trim(sprintf('%s %s', $this->getNumber(), $this->getAddition()));
    }

    public function getStreetWithoutNumberAndAddition(): string
    {
        return StripString::trimFromEnd($this->getStreet(), $this->getNumberWithAddition());
    }
}
