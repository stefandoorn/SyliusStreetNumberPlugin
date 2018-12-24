<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusStreetNumberPlugin\Helper;

use StefanDoorn\SyliusStreetNumberPlugin\Helper\StripString;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class StripStringSpec extends ObjectBehavior
{
    function it_is_initializable(): void
    {
        $this->shouldHaveType(StripString::class);
    }

    function it_should_strip_from_end(): void
    {
        $this::fromEnd('Long Test String', 'String')->shouldReturn('Long Test ');
        $this::fromEnd('Long String With Number 12', 12)->shouldReturn('Long String With Number ');
    }

    function it_should_strip_and_trim(): void
    {
        $this::trimFromEnd('Sesame Street 1a', '1a')->shouldReturn('Sesame Street');
        $this::trimFromEnd('Long String With Number 12', 12)->shouldReturn('Long String With Number');
    }
    
    function it_should_just_return_text_if_needle_not_in_haystack(): void
    {
        $this::trimFromEnd('Sesame Street 1a', 'blabla')->shouldReturn('Sesame Street 1a');
        $this::trimFromEnd('Long String With Number 12', 'blabla')->shouldReturn('Long String With Number 12');
    }
}
