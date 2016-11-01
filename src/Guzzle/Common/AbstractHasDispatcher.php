<?php

namespace Guzzle\Common;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class that holds an event dispatcher
 */
class AbstractHasDispatcher implements HasDispatcherInterface
{
    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /**
     * {@inheritdoc}
     */
    public static function getAllEvents()
    {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEventDispatcher()
    {
        if (!$this->eventDispatcher) {
            $this->eventDispatcher = new EventDispatcher();
        }

        return $this->eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($eventName, array $context = array())
    {
        $dispatcher = $this->getEventDispatcher();

        $event = new Event($context);
        $event->setEventDispatcher($dispatcher);
        $event->setName($eventName);

        return $dispatcher->dispatch($eventName, $event);
    }

    /**
     * {@inheritdoc}
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->getEventDispatcher()->addSubscriber($subscriber);

        return $this;
    }
}
