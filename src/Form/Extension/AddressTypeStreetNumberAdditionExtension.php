<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

final class AddressTypeStreetNumberAdditionExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('streetNumberAddition', TextType::class, [
            'label' => 'sylius.form.address.street_number_addition',
            'validation_groups' => ['sylius', 'sylius_shipping_address_update'],
        ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $data = $event->getData();

                $street = $data['street'];
                $streetNumberAddition = $data['streetNumberAddition'];

                // Add housenumber to street field to keep things compatible with Sylius
                if (false !== strrpos($street, $streetNumberAddition)) {
                    return;
                }

                $data['street'] = sprintf('%s %s', $street, $streetNumberAddition);
                $event->setData($data);
            });
    }

    public function getExtendedType()
    {
        return AddressType::class;
    }
}
