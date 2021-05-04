<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class labelCommand
 *
 * @package mh\entities\commands
 */
class labelCommand extends abstractCommand
{
    public function getName(): string
    {
        return 'Label';
    }

    public function getLabel(): string
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getLabel();
    }
}
