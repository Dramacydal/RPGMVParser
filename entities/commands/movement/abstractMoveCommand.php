<?php

namespace rp\entities\commands\movement;

use rp\entities\abstractCommand;

abstract class abstractMoveCommand extends abstractCommand
{
    protected function getStringPrefix(): string
    {
        return '◇';
    }
}
