<?php

declare(strict_types=1);

namespace App\Entity\Addressing;

use Doctrine\ORM\Mapping as ORM;
use StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\StreetNumberAwareInterface;
use StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits\StreetNumberAddition;
use Sylius\Component\Core\Model\Address as BaseAddress;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_address")
 */
class Address extends BaseAddress implements StreetNumberAwareInterface
{
    use StreetNumberAddition;
}
