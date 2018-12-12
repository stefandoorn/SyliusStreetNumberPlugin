# WORK IN PROGRESS - Sylius House Number Plugin

This plugin helps you split street & housenumber.

## Installation

1. Require plugin with composer:

    ```bash
    composer require stefandoorn/sylius-address-house-number-plugin
    ```

2. Add plugin class to your `AppKernel`.

    ```php
    $bundles = [
       new \StefanDoorn\SyliusAddressHouseNumberPlugin\SyliusAddressHouseNumberPlugin(),
    ];
    ```

X. Add doctrine mapping:

    ```yaml
    houseNumber:
        column: house_number
        type: string
        nullable: false
        options:
            default: ''
    ```

