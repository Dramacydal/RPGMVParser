<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifButtonCommand
 *
 *      [1] - button name
 *
 * @package mh\entities\commands\ifCommands
 */
class ifButtonCommand extends ifCommand
{
    public function getButton(): string
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return "Button [{$this->getButton()}] is pressed";
    }
}
