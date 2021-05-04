<?php

namespace rp\entities;

class commonEvent extends abstractCommandContainer
{
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
        return $this->data['name'] ?? '';
    }

    public function buildFileName()
    {
        return "CommonEvent_{$this->getId()}.txt";
    }
}
