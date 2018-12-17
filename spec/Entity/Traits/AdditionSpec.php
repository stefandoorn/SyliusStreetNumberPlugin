<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Traits\Number;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class AdditionSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beAnInstanceOf('StefanDoorn\SyliusStreetNumberPlugin\Entity\Address');
    }

    function it_should_return_no_addition(): void
    {
        $this->getAddition()->shouldReturn(null);
    }

    function it_should_return_addition(): void
    {
        $this->setAddition('a')->shouldReturn(null);

        $this->getAddition()->shouldReturn('a');
    }
}
