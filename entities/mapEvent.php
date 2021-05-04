<?php

namespace rp\entities;

class mapEvent extends abstractEntity
{
    /** @var map */
    private $map;

    /**
     * @return mixed
     */
    public function getMapId()
    {
        return $this->getMap()->getId();
    }

    /**
     * @return mixed
     */
    public function getMapName()
    {
        return $this->getMap()->getMapName();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->data['id'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->data['name'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->data['x'] ?? null;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->data['y'] ?? null;
    }

    /**
     * @return \Generator
     */
    public function getPages(): \Generator
    {
        if (empty($this->data['pages'])) {
            return;
        }

        foreach (array_keys($this->data['pages']) as $pageId) {
            yield $pageId => $this->getPage($pageId + 1);
        }
    }

    /**
     * @param int $index
     *
     * @return eventPage|null
     */
    public function getPage(int $index): ?eventPage
    {
        $page = !empty($this->data['pages'][$index - 1]) ? $this->data['pages'][$index - 1] : null;
        if (is_array($page)) {
            $page = new eventPage($page, $this->getP());
            $page->setPageId($index);
            $page->setEvent($this);

            $this->data['pages'][$index - 1] = $page;
        }

        return $page;
    }

    public function setMap(map $param)
    {
        $this->map = $param;
    }

    /**
     * @return map
     */
    public function getMap(): map
    {
        return $this->map;
    }

    public function setIsModified(bool $on): void
    {
        parent::setIsModified($on);
        if ($on) {
            $this->getMap()->setIsModified(true);
        }
    }
}
