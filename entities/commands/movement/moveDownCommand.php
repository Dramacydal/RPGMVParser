<?php

namespace rp\entities\commands\movement;

/**
 * Class moveDownCommand
 *
 * @package mh\entities\commands\movement
 */
class moveDownCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move Down';
    }
}
