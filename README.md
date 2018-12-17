# WORK IN PROGRESS - Sylius Street Number Plugin

This plugin helps you split street & number.

## Installation

1. Require plugin with composer:

    ```bash
    composer require stefandoorn/sylius-street-number-plugin
    ```

2. Add plugin class to your `AppKernel`.

    ```php
    $bundles = [
       new \StefanDoorn\SyliusStreetNumberPlugin\SyliusStreetNumberPlugin(),
    ];
    ```

3. Add to your config:

    ```yaml
    - { resource: "@SyliusStreetNumberPlugin/Resources/config/config.yml" }
    ```

4. (optional) Load resource override (if you don't have this done in your project yet):

    ```yaml
    - { resource: "@SyliusStreetNumberPlugin/Resources/config/resources.yml" }
    ```

5. Add doctrine mapping (`config/doctrine/Address.orm.yml`):

    ```yaml
    StefanDoorn\SyliusAddressHouseNumberPlugin\Entity\Address:
        type: entity
        table: sylius_address
        fields:
            streetNumber:
                column: street_number
                type: string
                nullable: false
                options:
                    default: ''
    ```
    
    In case you already extended the Address class, only use the part that defines the field.

6. Add to `SyliusAdminBundle/views/Common/Form/_address.html.twig`:

    ```twig
    {{ form_row(form.streetNumber) }}
    ```
    
7. Add to `SyliusShopBundle/views/Common/Form/_address.html.twig`:
    
    ```twig
    {{ form_row(form.streetNumber) }}
    ```
    