<?php

namespace rp\entities\commands\movement;

/**
 * Class moveWaitCommand
 *
 * @package mh\entities\commands\movement
 */
class moveWaitCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Wait';
    }

    public function getFrames(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return "{$this->getFrames()} frame(s)";
    }
}
