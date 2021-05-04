<?php

namespace rp\entities\commands\movement;

use rp\entities\abstractCommand;

/**
 * Class moveJumpCommand
 *
 * @package mh\entities\commands\movement
 */
class moveJumpCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Jump';
    }

    public function getXDelta(): int
    {
        return $this->getParameter(0);
    }

    public function getYDelta(): int
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        $x = $this->getXDelta() >= 0 ? "+{$this->getXDelta()}" : $this->getXDelta();
        $y = $this->getYDelta() >= 0 ? "+{$this->getYDelta()}" : $this->getYDelta();

        return "$x, $y";
    }
}
