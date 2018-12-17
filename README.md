# WORK IN PROGRESS - Sylius Street Number Plugin

This plugin helps you split street & number.

Features:

* Add `streetNumber` field to Address form (and database)

Optional features:

* Add `streetNumberAddition` field to Address form (and database)

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
    
4. (optional) Load address resource override (if you don't have this done in your project yet):

    ```yaml
    - { resource: "@SyliusStreetNumberPlugin/Resources/config/resources.yml" }
    ```

5. Add doctrine mapping fields for table `sylius_address` (`config/doctrine/Address.orm.yml`):

    ```yaml
        ...
        table: sylius_address
        fields:
            streetNumber:
                column: street_number
                type: string
                nullable: false
                options:
                    default: ''
            streetNumberAddition:
                column: street_number_addition
                type: string
                nullable: true                 
    ```
    
    In case you haven't already extended the Address class, Symfony will use the one from this bundle.
    
    The `streetNumberAddition` field is always added, regardless whether you use it. It will be `null` in that cae.

6. Add to `SyliusAdminBundle/views/Common/Form/_address.html.twig`:

    ```twig
    {{ form_row(form.streetNumber) }}
    ```
    
7. Add to `SyliusShopBundle/views/Common/Form/_address.html.twig`:
    
    ```twig
    {{ form_row(form.streetNumber) }}
    ```
    
8. Update database:

    ```bash
    $ bin/console doctrine:migrations:diff
    $ bin/console doctrine:migrations:migrate
    ```    

## (Optional) Add `streetNumberAddition` field

1. Enable in config (for form extension):

    ```yaml
    sylius_street_number:
        features:
            street_number_addition: true
    ```

2. Add to `SyliusAdminBundle/views/Common/Form/_address.html.twig`:

    ```twig
    {{ form_row(form.streetNumberAddition) }}
    ```
    
3. Add to `SyliusShopBundle/views/Common/Form/_address.html.twig`:
    
    ```twig
    {{ form_row(form.streetNumberAddition) }}
    ```
    