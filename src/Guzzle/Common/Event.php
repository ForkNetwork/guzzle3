<?php

namespace Guzzle\Common;

use Symfony\Component\EventDispatcher\Event as SymfonyEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Default event for Guzzle notifications
 */
class Event extends SymfonyEvent implements ToArrayInterface, \ArrayAccess, \IteratorAggregate
{
    /** @var array */
    private $context;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /** @var string */
    private $name;

    /**
     * @param array $context Contextual information
     */
    public function __construct(array $context = array())
    {
        $this->context = $context;
    }

    /**
     * Set the event dispatcher that sends this event.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Get the event dispatcher.
     *
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher()
    {
        return $this->eventDispatcher;
    }

    /**
     * Set the name of this event.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of the event.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->context);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->context[$offset]) ? $this->context[$offset] : null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->context[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->context[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->context[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return $this->context;
    }
}
