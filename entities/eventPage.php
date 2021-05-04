<?php

namespace rp\entities;

class eventPage extends abstractCommandContainer
{
    protected $pageId;

    /** @var mapEvent */
    private $mapEvent;

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->getEvent()->getId();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->pageId;
    }

    /**
     * @param mixed $pageId
     */
    public function setPageId($pageId): void
    {
        $this->pageId = $pageId;
    }

    public function setIsModified(bool $on): void
    {
        parent::setIsModified($on);
        if ($on) {
            $this->getEvent()->setIsModified(true);
        }
    }

    /**
     * @param mapEvent $mapEvent
     */
    public function setEvent(mapEvent $mapEvent)
    {
        $this->mapEvent = $mapEvent;
    }

    /**
     * @return mapEvent
     */
    public function getEvent(): mapEvent
    {
        return $this->mapEvent;
    }

    public function buildFileName()
    {
        return "{$this->getEvent()->getMapId()}_{$this->getEvent()->getMapName()}_Event_{$this->getEvent()->getId()}_Page_{$this->getId()}.txt";
    }
}
