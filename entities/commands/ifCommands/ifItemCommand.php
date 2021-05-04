<?php

namespace rp\entities\commands\ifCommands;

use rp\entities\commands\ifCommand;

/**
 * Class ifItemCommand
 *
 *      [1] - item id
 *
 * @package mh\entities\commands\ifCommands
 */
class ifItemCommand extends ifCommand
{
    public function getItem(): int
    {
        return $this->getParameter(1);
    }

    public function getParametersDescription(): string
    {
        return "Party has item #{$this->getItem()}";
    }
}
