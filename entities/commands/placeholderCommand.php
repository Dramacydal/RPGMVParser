<?php

namespace rp\entities\commands;

use rp\entities\abstractCommand;

/**
 * Class placeholderCommand
 *
 * @package mh\entities\commands
 */
class placeholderCommand extends abstractCommand
{
    public function getName(): string
    {
        return "Action {$this->getCode()}";
    }

    public function getParametersDescription(): string
    {
        return json_encode($this->getParameters());
    }
}
