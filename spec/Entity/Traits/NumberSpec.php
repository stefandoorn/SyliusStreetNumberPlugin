<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits\Number;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class NumberSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beAnInstanceOf('StefanDoorn\SyliusStreetNumberPlugin\Entity\Address');
    }

    function it_should_always_return_string_for_number(): void
    {
        $this->getNumber()->shouldReturn('');
    }

    function it_should_return_number(): void
    {
        $this->setNumber('1')->shouldReturn(null);

        $this->getNumber()->shouldReturn('1');
    }
}
