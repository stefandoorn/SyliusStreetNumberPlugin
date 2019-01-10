<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusStreetNumberPlugin\Form\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class AppendDataToStreetFieldEventSubscriber implements EventSubscriberInterface
{
    private const FIELD_STREET = 'street';

    /** @var string */
    private $field;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'onPreSubmit',
        ];
    }

    public function onPreSubmit(FormEvent $event): void
    {
        $data = $event->getData();

        $street = $data[self::FIELD_STREET];
        $fieldData = $data[$this->field];

        // Add field data to street field to keep things compatible with Sylius
        if (false !== strrpos($street, $fieldData)) {
            return;
        }

        $data[self::FIELD_STREET] = sprintf('%s %s', $street, $fieldData);
        $event->setData($data);
    }
}
