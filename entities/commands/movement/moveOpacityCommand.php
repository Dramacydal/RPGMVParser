<?php

namespace rp\entities\commands\movement;

/**
 * Class moveOpacityCommand
 *
 * @package mh\entities\commands\movement
 */
class moveOpacityCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Opacity';
    }

    public function getOpacity(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getOpacity();
    }
}
