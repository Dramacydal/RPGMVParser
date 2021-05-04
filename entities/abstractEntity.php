<?php

namespace rp\entities;

use rp\parser;

abstract class abstractEntity implements \JsonSerializable
{
    private $isModified = false;
    protected $data = [];
    private $p = null;

    public function __construct(array $data, parser $p)
    {
        $this->data = $data;
        $this->p = $p;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
        $this->setIsModified(true);
    }

    /**
     * @return bool
     */
    public function isModified(): bool
    {
        return $this->isModified;
    }

    /**
     * @param bool $on
     */
    public function setIsModified(bool $on): void
    {
        $this->isModified = $on;
    }

    public function getP(): parser
    {
        return $this->p;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }
}
