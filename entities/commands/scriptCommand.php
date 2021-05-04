<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class scriptCommand
 *
 * @package mh\entities\commands
 */
class scriptCommand extends abstractCommand
{
    function getName(): string
    {
        return 'Script';
    }

    public function getScript(): string
    {
        return $this->getParameter(0);
    }

    public function getParametersDescription(): string
    {
        return $this->getScript();
    }
}
