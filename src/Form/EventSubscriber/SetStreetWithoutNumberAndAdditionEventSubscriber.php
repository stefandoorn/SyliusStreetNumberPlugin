<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Form\EventSubscriber;

use StefanDoorn\SyliusStreetNumberPlugin\Entity\Interfaces\StreetNumberAwareInterface;
use Sylius\Component\Core\Model\AddressInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class SetStreetWithoutNumberAndAdditionEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'onPreSetData',
        ];
    }

    public function onPreSetData(FormEvent $event): void
    {
        /** @var StreetNumberAwareInterface|AddressInterface $data */
        $data = $event->getData();

        if (!$data instanceof AddressInterface) {
            return;
        }

        if (null === $data->getId()) {
            return; // Only adjust the data from already saved entities (we add it below only on PRE SUBMIT)
        }

        $data->setStreet($data->getStreetWithoutNumberAndAddition());
        $event->setData($data);
    }
}
