<?php

namespace rp\entities\commands\movement;

/**
 * Class moveScriptCommand
 *
 * @package mh\entities\commands\movement
 */
class moveScriptCommand extends abstractMoveCommand
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
