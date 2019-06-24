<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Form\EventSubscriber;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\AddressInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class RemoveDuplicateAdditionEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::POST_SUBMIT => 'onPostSubmit',
        ];
    }

    public function onPostSubmit(FormEvent $event): void
    {
        /** @var AddressInterface $data */
        $data = $event->getData();

        if (!$data instanceof AddressInterface) {
            return;
        }

        $streetNumber = sprintf('%s %s', $data->getStreetWithoutNumberAndAddition(), $data->getNumber());

        if ($data->getAddition() !== $streetNumber) {
            return;
        }

        $data->setAddition(null);
        $data->setStreet($streetNumber);
    }
}
