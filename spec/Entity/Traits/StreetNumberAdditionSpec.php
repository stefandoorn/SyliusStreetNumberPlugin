<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits\Number;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class StreetNumberAdditionSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beAnInstanceOf('StefanDoorn\SyliusStreetNumberPlugin\Entity\Address');
    }

    public function it_should_return_number_with_addition(): void
    {
        $this->setNumber('1')->shouldReturn(null);
        $this->setAddition('a')->shouldReturn(null);

        $this->getNumberWithAddition()->shouldReturn('1 a');
    }

    public function it_should_return_street_without_number_and_addition(): void
    {
        $this->setStreet('Sesame Street 1 a')->shouldReturn(null);
        $this->setNumber('1')->shouldReturn(null);
        $this->setAddition('a')->shouldReturn(null);

        $this->getStreetWithoutNumberAndAddition()->shouldReturn('Sesame Street');
    }
}
