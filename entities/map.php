<?php

namespace rp\entities;

class map extends abstractEntity
{
    protected $id;
    protected $mapName;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMapName(): string
    {
        if ($this->mapName === null) {
            $mapInfo = $this->getP()->getMapInfo($this->getId());
            $this->mapName = $mapInfo['name'] ?? "<unknown map {$this->getId()}>";
        }

        return $this->mapName;
    }

    /**
     * @return \Generator
     */
    public function getEvents(): \Generator
    {
        if (empty($this->data['events'])) {
            return;
        }

        foreach (array_keys($this->data['events']) as $eventId) {
            $event = $this->getEvent($eventId);
            if ($event === null) {
                continue;
            }

            yield $eventId => $event;
        }
    }

    /**
     * @param int $index
     *
     * @return mapEvent
     */
    public function getEvent(int $index): ?mapEvent
    {
        $event = !empty($this->data['events'][$index]) ? $this->data['events'][$index] : null;
        if (is_array($event)) {
            $event = new mapEvent($event, $this->getP());
            $event->setMap($this);
            $this->data['events'][$index] = $event;
        }

        return $event;
    }
}
