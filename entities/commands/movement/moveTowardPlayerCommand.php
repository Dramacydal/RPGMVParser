<?php

namespace rp\entities\commands\movement;

/**
 * Class moveTowardPlayerCommand
 *
 * @package mh\entities\commands\movement
 */
class moveTowardPlayerCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move toward Player';
    }
}
