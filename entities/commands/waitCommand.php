<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class waitCommand
 *
 * @package mh\entities\commands
 */
class waitCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Wait';
    }

    public function getFrameCount(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return "{$this->getFrameCount()} frame(s)";
    }
}
