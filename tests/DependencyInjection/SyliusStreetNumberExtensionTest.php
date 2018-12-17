<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusStreetNumberPlugin\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use StefanDoorn\SyliusStreetNumberPlugin\DependencyInjection\SyliusStreetNumberExtension;
use PHPUnit\Framework\TestCase;

final class SyliusReserveStockExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [new SyliusStreetNumberExtension()];
    }

    public function testDefaults(): void
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('sylius_street_number_plugin.features.street_number', true);
        $this->assertContainerBuilderHasParameter('sylius_street_number_plugin.features.street_number_addition', false);
    }

    public function testDisableNumber(): void
    {
        $this->load(['features' => [
            'street_number' => false,
        ]]);

        $this->assertContainerBuilderHasParameter('sylius_street_number_plugin.features.street_number', false);
        $this->assertContainerBuilderHasParameter('sylius_street_number_plugin.features.street_number_addition', false);
    }

    public function testEnableAddition(): void
    {
        $this->load(['features' => [
            'street_number' => false,
            'street_number_addition' => true,
        ]]);

        $this->assertContainerBuilderHasParameter('sylius_street_number_plugin.features.street_number', false);
        $this->assertContainerBuilderHasParameter('sylius_street_number_plugin.features.street_number_addition', true);
    }
}
