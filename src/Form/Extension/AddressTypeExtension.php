<?php

namespace StefanDoorn\SyliusAddressHouseNumberPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class AddressTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('houseNumber', TextType::class, [
            'required' => true,
            'label' => 'sylius.form.address.house_number',
            'constraints' => [new NotBlank([
                'message' => 'sylius.address.house_number.not_blank',
                'groups' => ['sylius', 'sylius_shipping_address_update']
            ])],
            'validation_groups' => ['sylius', 'sylius_shipping_address_update'],
        ]);
    }

    public function getExtendedType()
    {
        return AddressType::class;
    }
}
