<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Form\Extension;

use Sylius\Bundle\AddressingBundle\Form\Type\AddressType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

final class AddressTypeStreetNumberExtension extends AbstractTypeExtension
{
    /** @var EventSubscriberInterface */
    private $setStreetNumberWithoutNumberAndAdditionEventSubscriber;

    /** @var EventSubscriberInterface */
    private $appendNumberDataToStreetFieldEventSubscriber;

    public function __construct(
        EventSubscriberInterface $setStreetNumberWithoutNumberAndAdditionEventSubscriber,
        EventSubscriberInterface $appendNumberDataToStreetFieldEventSubscriber
    ) {
        $this->setStreetNumberWithoutNumberAndAdditionEventSubscriber = $setStreetNumberWithoutNumberAndAdditionEventSubscriber;
        $this->appendNumberDataToStreetFieldEventSubscriber = $appendNumberDataToStreetFieldEventSubscriber;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'number',
            TextType::class,
            [
                'required' => true,
                'label' => 'sylius.form.address.street_number',
                'constraints' => [
                    new NotBlank(
                        [
                            'message' => 'sylius.address.street_number.not_blank',
                            'groups' => ['sylius', 'sylius_shipping_address_update'],
                        ]
                    ),
                ],
                'validation_groups' => ['sylius', 'sylius_shipping_address_update'],
            ]
        );

        $builder->addEventSubscriber($this->setStreetNumberWithoutNumberAndAdditionEventSubscriber);
        $builder->addEventSubscriber($this->appendNumberDataToStreetFieldEventSubscriber);
    }

    public function getExtendedType()
    {
        return AddressType::class;
    }
}
