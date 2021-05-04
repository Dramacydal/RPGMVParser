<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifScriptCommand
 *
 *      [1] - scenario name
 *
 * @package mh\entities\commands\ifCommands
 */
class ifScriptCommand extends ifCommand
{
    public function getScenario(): string
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return "Script: '{$this->getScenario()}'";
    }
}
