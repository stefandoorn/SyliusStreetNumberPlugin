<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Helper;

final class StripString
{
    public static function fromEnd(string $haystack, string $needle): string
    {
        if (false === strpos($haystack, $needle)) {
            return $haystack;
        }

        return substr($haystack, 0, -1 * strlen($needle));
    }

    public static function trimFromEnd(string $haystack, string $needle): string
    {
        return trim(static::fromEnd($haystack, $needle));
    }
}
