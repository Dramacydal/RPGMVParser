<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class fadeoutBGMCommand
 *
 * @package mh\entities\commands
 */
class fadeoutBGMCommand extends abstractCommand
{
    public function getName(): string
    {
        return 'Fadeout BGM';
    }

    public function getSeconds(): int
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return "{$this->getSeconds()} second(s)";
    }
}
