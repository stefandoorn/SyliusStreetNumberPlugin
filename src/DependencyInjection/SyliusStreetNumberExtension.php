<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SyliusStreetNumberExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);

        $xmlFileLoader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $xmlFileLoader->load('services.xml');

        foreach ($config['features'] as $feature => $setting) {
            $container->setParameter(sprintf('sylius_street_number_plugin.features.%s', $feature), $setting);

            if ($setting === true) {
                $xmlFileLoader->load(sprintf('services_features/%s.xml', $feature));
            }
        }
    }
}
