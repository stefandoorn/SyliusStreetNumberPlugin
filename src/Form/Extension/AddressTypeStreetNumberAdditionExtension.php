<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class AddressTypeStreetNumberAdditionExtension extends AbstractTypeExtension
{
    /** @var EventSubscriberInterface */
    private $appendAdditionDataToStreetFieldEventSubscriber;

    public function __construct(EventSubscriberInterface $appendAdditionDataToStreetFieldEventSubscriber)
    {
        $this->appendAdditionDataToStreetFieldEventSubscriber = $appendAdditionDataToStreetFieldEventSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'addition',
            TextType::class,
            [
                'required' => false,
                'label' => 'sylius.form.address.street_number_addition',
                'validation_groups' => ['sylius', 'sylius_shipping_address_update'],
            ]
        );

        $builder->addEventSubscriber($this->appendAdditionDataToStreetFieldEventSubscriber);
    }

    public function getExtendedType()
    {
        return AddressType::class;
    }
}
