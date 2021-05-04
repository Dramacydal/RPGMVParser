<?php

namespace rp\entities\commands\movement;

/**
 * Class moveFrequencyCommand
 *
 * @package mh\entities\commands\movement
 */
class moveFrequencyCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Frequency';
    }

    public function getFrequency(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getFrequency();
    }
}
