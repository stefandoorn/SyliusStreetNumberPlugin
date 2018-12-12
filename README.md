# Sylius House Number Plugin

This plugin helps you split street & housenumber.

## Installation

X. Add doctrine mapping:

    ```yaml
    houseNumber:
        column: house_number
        type: string
        nullable: false
        options:
            default: ''
    ```

