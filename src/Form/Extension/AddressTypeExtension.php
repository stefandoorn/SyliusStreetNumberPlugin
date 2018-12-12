<?php

namespace StefanDoorn\SyliusAddressHouseNumberPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

final class AddressTypeExtension extends AbstractTypeExtension
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('houseNumber', TextType::class, [
            'required' => true,
            'label' => 'sylius.form.address.house_number',
            'constraints' => [
                new NotBlank([
                    'message' => 'sylius.address.house_number.not_blank',
                    'groups' => ['sylius', 'sylius_shipping_address_update'],
                ]),
            ],
            'validation_groups' => ['sylius', 'sylius_shipping_address_update'],
        ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT,
            function (FormEvent $event) {
                $data = $event->getData();

                $street = $data['street'];
                $streetNumber = $data['houseNumber'];

                // Add housenumber to street field to keep things compatible with Sylius
                if (false !== strrpos($street, $streetNumber)) {
                    return;
                }

                $data['street'] = sprintf('%s %s', $street, $streetNumber);
                $event->setData($data);
            });
    }

    public function getExtendedType()
    {
        return AddressType::class;
    }
}
