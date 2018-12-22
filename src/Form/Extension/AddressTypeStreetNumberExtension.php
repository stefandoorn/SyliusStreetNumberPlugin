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

final class AddressTypeStreetNumberExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('number', TextType::class, [
            'required' => true,
            'label' => 'sylius.form.address.street_number',
            'constraints' => [new NotBlank([
                'message' => 'sylius.address.street_number.not_blank',
                'groups' => ['sylius', 'sylius_shipping_address_update'],
            ])],
            'validation_groups' => ['sylius', 'sylius_shipping_address_update'],
        ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var \StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\AddressInterface $data */
            $data = $event->getData();

            if (!$data) {
                return;
            }

            if (null === $data->getId()) {
                return; // Only adjust the data from already saved entities (we add it below only on PRE SUBMIT)
            }

            $data->setStreet($data->getStreetWithoutNumberAndAddition());
            $event->setData($data);
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();

            $street = $data['street'];
            $streetNumber = $data['number'];

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
