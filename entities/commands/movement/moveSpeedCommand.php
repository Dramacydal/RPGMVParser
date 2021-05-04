<?php

namespace rp\entities\commands\movement;

/**
 * Class moveSpeedCommand
 *
 * @package mh\entities\commands\movement
 */
class moveSpeedCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Speed';
    }

    public function getSpeed(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getSpeed();
    }
}
