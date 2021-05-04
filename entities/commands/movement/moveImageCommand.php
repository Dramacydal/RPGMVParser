<?php

namespace rp\entities\commands\movement;

/**
 * Class moveImageCommand
 *
 * @package mh\entities\commands\movement
 */
class moveImageCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Image';
    }

    public function getImage(): string
    {
        return $this->getParameter(0);
    }

    public function getOffset(): int
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        $image = $this->getImage();
        if (empty($image)) {
            return 'None';
        } else {
            return "{$image}({$this->getOffset()})";
        }
    }
}
