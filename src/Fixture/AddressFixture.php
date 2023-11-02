<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AddressFixture as BaseAddressFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class AddressFixture extends BaseAddressFixture
{
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        $resourceNode
            ->children()
                ->scalarNode('first_name')->cannotBeEmpty()->end()
                ->scalarNode('last_name')->cannotBeEmpty()->end()
                ->scalarNode('phone_number')->end()
                ->scalarNode('company')->end()
                ->scalarNode('street')->cannotBeEmpty()->end()
                ->scalarNode('number')->end()
                ->scalarNode('addition')->end()
                ->scalarNode('city')->cannotBeEmpty()->end()
                ->scalarNode('postcode')->cannotBeEmpty()->end()
                ->scalarNode('country_code')->cannotBeEmpty()->end()
                ->scalarNode('province_code')->end()
                ->scalarNode('province_name')->end()
                ->scalarNode('customer')->cannotBeEmpty()->end()
        ;
    }
}
