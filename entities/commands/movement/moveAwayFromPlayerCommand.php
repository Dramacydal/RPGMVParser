<?php

namespace rp\entities\commands\movement;

/**
 * Class moveAwayFromPlayerCommand
 *
 * @package mh\entities\commands\movement
 */
class moveAwayFromPlayerCommand extends abstractMoveCommand
{
    function getName(): string
    {
        return 'Move away from Player';
    }
}
