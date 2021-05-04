<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class pluginCommand
 *
 * @package mh\entities\commands
 */
class pluginCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Plugin Command';
    }

    public function getCommand(): string
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getCommand();
    }
}
